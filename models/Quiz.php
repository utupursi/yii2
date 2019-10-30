<?php

namespace app\models;

use Symfony\Component\CssSelector\Tests\Node\AbstractNodeTest;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "quiz".
 *
 * @property int $id
 * @property int $min_correct
 * @property int $created_at
 * @property int $updated_at
 * @property int $max_question
 * @property string $subject
 * @property int $created_by
 * @property int $updated_by
 * @property int $certificate_valid_time
 *
 * @property Question[] $questions
 * @property User $createdBy
 * @property User $updatedBy
 * @property Result[] $results
 */
class Quiz extends \yii\db\ActiveRecord
{
    public $questionCount;
    public $questionCountFromDb;
    public $quiz;
    public $count;
    public $question;
    public $success;
    public $error;
    public $searchModel;
    public $dataProvider;
    public $masivi;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quiz';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_AFTER_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],

            'class' => BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_correct', 'created_at', 'updated_at', 'max_question', 'created_by', 'updated_by', 'certificate_valid_time'], 'integer'],
            [['subject'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['subject', 'min_correct', 'max_question', 'certificate_valid_time'], 'required'],
            [['min_correct', 'max_question'], 'integer', 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'min_correct' => 'Min Correct',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'max_question' => 'Max Question',
            'subject' => 'Subject',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'certificate_valid_time' => 'Certificate Valid Time'
        ];
    }

    public function getQuiz($id)
    {
        $this->quiz = Quiz::findOne($id);
        return $this->quiz;
    }

    public function getQuestion($id)
    {
        $this->question = Question::find()
            ->where(['quiz_id' => $id])
            ->with(['answers'])
            ->all();
        return $this->question;
    }

    public function countCorrectAnswers($getPost, $id)
    {
        $this->quiz = Quiz::findOne($id);
        $this->question = Question::find()
            ->where(['quiz_id' => $id])
            ->with(['answers'])
            ->all();

        $post = $getPost;
        $this->count = 0;
        $this->questionCount = 0;
        $answerIds = [];

        foreach ($post as $index => $answerId) {
            if (strpos($index, 'selectedAnswer') !== false) {
                $this->questionCount++;
                $answerIds[] = $answerId;
            }
        }

        $answers = Answer::find()
            ->andWhere(['id' => $answerIds])
            ->all();

        foreach ($answers as $answer) {
            if ($answer->is_correct) {
                $this->count++;
            }
        }

        $this->error = $this->count < $this->quiz->min_correct ? 'You have  not  passed quiz' : '';
        $this->success = $this->count < $this->quiz->min_correct ? '' : 'You have successfully passed quiz';

        $this->questionCountFromDb = Question::find()
            ->where(['quiz_id' => $id])
            ->count();


    }

    public function errorOfChoose()
    {

        if ($this->questionCount != $this->questionCountFromDb) {
            return true;
        }

    }

    public function insertData()
    {
        $modelResult = new Result();

        if (!$modelResult->insertResult($this->quiz->min_correct, $this->quiz->subject, $this->count,
            $this->questionCountFromDb, $this->quiz->certificate_valid_time, Yii::$app->user->identity->id)) {
            return false;
        }
    }

    public function errorOfQuiz($id)
    {
        $ques = Question::find()->where(['quiz_id' => $id])->all();
        $this->masivi = [];

        foreach ($ques as $qu) {
            $this->masivi[] = $qu['id'];;
        }


        if ($ques == []) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        }
    }

    public function errorOfAnswers()
    {
        $answer = Answer::find()->where(['question_id' => $this->masivi])->asArray()->all();
        $i = 0;
        $g = 0;
        $array = [];
        foreach ($answer as $ans) {
            $array[] = $ans['question_id'];

        }
        $arrayOfQuestionId = array_unique($array);

        foreach ($arrayOfQuestionId as $arr) {
            if (in_array($arr, $this->masivi)) {
                $ansArray[] = $arr;
            }
        }

        if (isset($ansArray) == false) {
            $ansArray = [];
        }

        if (count($ansArray) != count($this->masivi)) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['quiz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['quiz_id' => 'id']);
    }
}
