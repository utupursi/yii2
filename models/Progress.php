<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "progress".
 *
 * @property int $id
 * @property int $question_id
 * @property int $is_correct
 * @property int $quiz_id
 * @property int $passed_by
 * @property int $current_question
 * @property int $selected_answer
 * @property int $quiz_start_date
 * @property User $passedBy
 * @property Answer $selectedAnswer
 */
class Progress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'progress';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['quiz_start_date'],
                ],
            ],


        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'is_correct', 'quiz_id', 'passed_by', 'current_question', 'selected_answer', 'quiz_start_date'], 'integer'],
            [['passed_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['passed_by' => 'id']],
            [['selected_answer'], 'exist', 'skipOnError' => true, 'targetClass' => Answer::className(), 'targetAttribute' => ['selected_answer' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'is_correct' => 'Is Correct',
            'quiz_id' => 'Quiz ID',
            'passed_by' => 'Passed By',
            'current_question' => 'Current Question',
            'selected_answer' => 'Selected Answer',
            'quiz_start_date' => 'Quiz start date'
        ];
    }

    public function insertData($selected, $questionId, $quizId, $isCorrect, $currentQuestion)
    {
        $progress = new Progress();
        $progress->selected_answer = $selected;
        $progress->question_id = $questionId;
        $progress->quiz_id = $quizId;
        $progress->is_correct = $isCorrect;
        $progress->current_question = $currentQuestion;
        $progress->passed_by = Yii::$app->user->identity->id;
        if ($progress->save()) {
            return true;
        } else {
            return false;
        }

    }

    public function startFromCurrentQuiz($data, $id)
    {
        $array = [];
        foreach ($data['answers'] as $answer) {
            $array[] = $answer['id'];
        }

        $quizStartOrNot = $this->find()->where(['passed_by' => Yii::$app->user->identity->id])->count();
        $selectedAnswer = $this->find()->andwhere(['selected_answer' => $array])->andWhere(['passed_by' => Yii::$app->user->identity->id])->count();
        $count = $this->find()->where(['question_id' => $data['question']])->andWhere(['passed_by' => Yii::$app->user->identity->id])->count();
        if ($quizStartOrNot == 0) {
            $this->insertData(null, null, $id, null, 0);
        }
        if ($selectedAnswer > 0) {
            return json_encode($this->find()->where(['selected_answer' => $array])->asArray()->one());
        } else if ($count == 0) {
            $this->insertData(null, $data['question'], $id, null, $data['currentQuestion']);
        }
    }

    public function quizStartDate($id)
    {
        return $this->find()->orderBy(['quiz_start_date' => SORT_DESC])
            ->andwhere(['quiz_id' => $id])
            ->andWhere(['passed_by' => Yii::$app->user->identity->id])
            ->asArray()
            ->one();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'passed_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSelectedAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'selected_answer']);
    }
}
