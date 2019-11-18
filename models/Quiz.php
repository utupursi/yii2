<?php

namespace app\models;

use dosamigos\datepicker\DatePicker;
use phpDocumentor\Reflection\DocBlock\Tags\Param;
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
 * @property int $quiz_time
 * @property int $quiz_start_date
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
    public $times;

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
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            [['min_correct', 'created_at', 'updated_at', 'max_question', 'created_by', 'updated_by', 'certificate_valid_time', 'quiz_time'], 'integer'],
            [['subject'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['subject', 'min_correct', 'max_question', 'certificate_valid_time'], 'required'],
            [['min_correct', 'max_question'], 'integer', 'min' => 1, 'max' => 20],
            ['max_question', 'leadingZeroValidateOfMaxQuestion'],
            ['min_correct', 'leadingZeroValidateOfMinCorrect'],
            ['max_question', 'compare', 'operator' => '>=', 'compareAttribute' => 'min_correct'],
            ['max_question', 'checkMaxQuestionCount'],

        ];
    }

    public function leadingZeroValidateOfMaxQuestion($attribute)
    {
        $arrayOfMaxQuestion = array_map('intval', str_split($this->max_question));
        if ($arrayOfMaxQuestion[0] == 0 && count($arrayOfMaxQuestion) > 1) {
            $this->addError($attribute, 'Minimal correct should no have leading zeros');
        }
    }

    public function leadingZeroValidateOfMinCorrect($attribute)
    {
        $arrayOfMinCorrect = array_map('intval', str_split($this->min_correct));
        if ($arrayOfMinCorrect[0] == 0 && count($arrayOfMinCorrect) > 1) {
            $this->addError($attribute, 'Minimal correct should not have leading zeros');
        }
    }


    public function checkMaxQuestionCount($attribute)
    {
        $questionsCount = Question::find()->where(['quiz_id' => $this->id])->count();

        if ($this->max_question < $questionsCount) {
            $this->addError($attribute, 'Maximal number questions can not be less than current number of questions');
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'min_correct' => 'Minimal correct answers',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'max_question' => 'Maximal Question',
            'subject' => 'Subject',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'certificate_valid_time' => 'Certificate Valid Time(Month)',
            'quiz_time' => 'Quiz time',
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
            ->asArray()
            ->all();
        return $this->question;
    }

    public function countCorrectAnswers($id)
    {

        $this->quiz = Quiz::findOne($id);

        $this->questionCountFromDb = Question::find()
            ->where(['quiz_id' => $id])
            ->count();


    }

    public function errorOfChoose($id)
    {

        $progressCount = Progress::find()->where(['quiz_id' => $id])
            ->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->andWhere(['not', ['question_id' => null]])
            ->count();
        $progressData = Progress::find()->where(['quiz_id' => $id])
            ->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->andWhere(['not', ['question_id' => null]])
            ->all();

        $array = [];
        $counter = 0;;
        for ($i = 0; $i < count($progressData); $i++) {
            if ($progressData[$i]['selected_answer'] == '') {
                $counter++;
            }
            $array[] = $progressData[$i]['question_id'];
        }
        $count = Question::find()->where(['id' => $array])->count();
        if ($progressCount != $count || $counter > 0) {
            return true;
        }
    }

    public function insertData($id)
    {
        $this->countCorrectAnswers($id);
        $count = Progress::find()->andwhere(['is_correct' => true])->andWhere(['quiz_id' => $id])
            ->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->count();
        $this->count = $count;


        $progress = new Progress();
        $modelResult = new Result();

        if (!$modelResult->insertResult($this->quiz->min_correct, $this->quiz->subject, $this->count,
            $this->questionCountFromDb, $this->quiz->certificate_valid_time, Yii::$app->user->identity->id)) {
            return false;
        }
    }

    public function errorOfQuiz($id)
    {
        $questions = Question::find()->where(['quiz_id' => $id])->all();
        $this->masivi = [];

        foreach ($questions as $question) {
            $this->masivi[] = $question['id'];
        }

        if ($questions == []) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        }
    }

    public function errorOfAnswers()
    {
        $answer = Answer::find()->where(['question_id' => $this->masivi])->asArray()->all();
        $i = 1;

        foreach ($answer as $ans) {
            if ($i < count($answer) && $answer[$i]['question_id'] == $answer[$i - 1]['question_id']) {
                $ansArray[] = $answer[$i - 1]['question_id'];
            }
            $i++;
        }

        if (isset($ansArray) == false) {
            $ansArray = [];
        }
        $ansArray = array_unique($ansArray);

        if (count($ansArray) != count($this->masivi)) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        }
    }

    public function errorOfCorrectAnswers()
    {
        $answer = Answer::find()->where(['question_id' => $this->masivi])->asArray()->orderBy('question_id')->all();
        $count = 0;

        $ansIsCorrect = [];
        $ansQuestionId = [];
        $i = 1;
        $answer[count($answer)] = 0;
        foreach ($answer as $ans) {
            $ansIsCorrect[] = $ans['is_correct'];
            if ($i < count($answer)) {

                if ($answer[$i]['question_id'] != $answer[$i - 1]['question_id']) {
                    $ansIsCorrect = array_unique($ansIsCorrect);

                    if (!in_array('1', $ansIsCorrect)) {
                        $count++;
                        break;
                    }
                    $ansIsCorrect = [];
                }

            }
            $i++;
        }

        if ($count > 0) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        }

    }

    public function errorNumberOfQuestion($id)
    {
        $questionsCount = Question::find()->where(['quiz_id' => $id])->count();
        $quiz = Quiz::findOne($id);

        if ($questionsCount < $quiz->min_correct) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        }
    }

    public function dropDownListItem()
    {
        $items = [
            0 => 1,
            1 => 2,
            2 => 3,
            3 => 4,
            4 => 8,
        ];
        return $items;
    }

    public function previousAjax($data)
    {
        $progress = new Progress();


        if ($data['selected'] != '') {
            $answers = Answer::find()->where(['id' => $data['selected']])->one();
            $isCorrect = $answers->is_correct == 1 ? 1 : 0;
        } else {
            $isCorrect = '';
        }
        $currentQuestion = $data['currentQuestion'] - 1;
        $count = $progress->find()->where(['question_id' => $data['question']])->andWhere(['passed_by' => Yii::$app->user->identity->id])->count();

        if ($count > 0) {
            $progress->updateALL(['question_id' => $data['question'], 'selected_answer'
            => $data['selected'], 'quiz_id' => $data['quizId'], 'is_correct' => $isCorrect, 'current_question' => $currentQuestion, 'quiz_start_date' => time()],
                ['passed_by' => Yii::$app->user->identity->id, 'question_id' => $data['question']]);
        } else {
            $progress->insertData($data['selected'], $data['question'], $data['quizId'], $isCorrect, $currentQuestion);
        }

        $array = [];
        foreach ($data['previousAnswers'] as $answer) {
            $array[] = $answer['id'];
        }

        $name = $progress->find()->where(['selected_answer' => $array])
            ->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->count();

        if ($name > 0) {
            return json_encode($progress->find()->andwhere(['selected_answer' => $array])
                ->andWhere(['passed_by' => Yii::$app->user->identity->id])
                ->asArray()->one());
        }
    }

    public
    function nextAjax($data)
    {
        $progress = new Progress();


        $array = [];
        foreach ($data['nextAnswers'] as $answer) {
            $array[] = $answer['id'];
        }

        if ($data['selected'] != '') {
            $answers = Answer::find()->where(['id' => $data['selected']])->one();
            $isCorrect = $answers->is_correct == 1 ? 1 : 0;
        } else {
            $isCorrect = '';
        }
        $currentQuestion = $data['currentQuestion'] + 1;

        $count = $progress->find()->where(['question_id' => $data['question']])->andWhere(['passed_by' => Yii::$app->user->identity->id])->count();

        if ($count > 0) {
            $progress->updateALL(['question_id' => $data['question'], 'selected_answer'
            => $data['selected'], 'quiz_id' => $data['quizId'], 'is_correct' => $isCorrect, 'current_question' => $currentQuestion,
                'quiz_start_date' => time()],
                ['passed_by' => Yii::$app->user->identity->id, 'question_id' => $data['question']]);
        } else {
            $progress->insertData($data['selected'], $data['question'], $data['quizId'], $isCorrect, $currentQuestion);
        }

        $name = $progress->find()->where(['selected_answer' => $array])
            ->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->count();

        if ($name > 0) {
            return json_encode($progress->find()->andwhere(['selected_answer' => $array])
                ->andWhere(['passed_by' => Yii::$app->user->identity->id])
                ->asArray()->one());

        }
    }

    public
    function finishAjax($data, $id)
    {
        $quiz = new Quiz();
        $progress = new Progress();
        if ($data['selected'] != '') {
            $answers = Answer::find()->where(['id' => $data['selected']])->one();
            $isCorrect = $answers->is_correct == 1 ? 1 : 0;
        } else {
            $isCorrect = '';
        }
        $count = $progress->find()->where(['question_id' => $data['question']])->andWhere(['passed_by' => Yii::$app->user->identity->id])->count();
        $currentQuestion = $data['currentQuestion'];
        if ($count > 0) {
            $progress->updateALL(['question_id' => $data['question'], 'selected_answer'
            => $data['selected'], 'quiz_id' => $data['quizId'], 'is_correct' => $isCorrect, 'current_question' => $currentQuestion],
                ['passed_by' => Yii::$app->user->identity->id, 'question_id' => $data['question']]);
        }


        if ($quiz->errorOfChoose($id) === true) {
            return true;
        } else {
            return false;
        }
    }

    public
    function progressQuizId()
    {
        $progress = Progress::find()->where(['passed_by' => Yii::$app->user->identity->id])->all();
        $array = [];
        foreach ($progress as $progres) {
            $array[] = $progres->quiz_id;
        }
        return $array;
    }

    public function errorOfStartQuiz($id)
    {
        $progress = Progress::find()->where(['passed_by' => Yii::$app->user->identity->id])->andWhere(['quiz_id' => $id])->all();
        if ($this->progressQuizId() != [] && $progress == []) {
            $this->searchModel = new QuizSearch();
            $this->dataProvider = $this->searchModel->search(Yii::$app->request->queryParams);
            return true;
        } else {
            return false;
        }
    }

    public function getDataOfResult($name, $id)
    {
        $this->countCorrectAnswers($id);
        $result = Result::find()->where(['quiz_name' => $name])->orderBy(['id' => SORT_DESC])->one();

        $this->error = $result->correct_answer_count < $this->quiz->min_correct ? 'You have  not  passed quiz' : '';
        $this->success = $result->correct_answer_count < $this->quiz->min_correct ? '' : 'You have successfully passed quiz';
        return $result->correct_answer_count;

    }

    public function getQuizTimeLeft($id)
    {
        $quizCount = Quiz::find()->where(['id' => $id])->andWhere(['quiz_time' => null])->count();

        $quiz = Quiz::find()->where(['id' => $id])->andWhere(['not', ['quiz_time' => null]])->one();

        $progress = Progress::find()->where(['quiz_id' => $id])->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->orderBy(['id' => SORT_ASC])->one();
        if ($quizCount == 0) {
            $date = strtotime(date("H:i:s", time()) . '+' . '4' . 'hour');
            $date1 = strtotime(date(" H:i:s", $progress->quiz_start_date) . '+' . '4' . 'hour');
            $time = ($date - $date1);
            $this->times = date('H:i:s', $time);

            if (date('H', strtotime($this->times)) < $quiz->quiz_time) {
                return true;
            } else {
                $progress->deleteALL(['quiz_id' => $id, 'passed_by' => Yii::$app->user->identity->id]);
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public
    function getQuestions()
    {
        return $this->hasMany(Question::className(), ['quiz_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public
    function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public
    function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public
    function getResults()
    {
        return $this->hasMany(Result::className(), ['quiz_id' => 'id']);
    }
}
