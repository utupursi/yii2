<?php

namespace app\models;

use Yii;

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
 *
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'is_correct', 'quiz_id', 'passed_by', 'current_question', 'selected_answer'], 'integer'],
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
        if ($progress->save()) {
            return true;
        } else {
            return false;
        }

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
