<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "progress".
 *
 * @property int $id
 * @property string $selected_answer
 * @property int $question_id
 * @property int $is_correct
 * @property int $quiz_id
 * @property int $passed_by
 * @property int $current_question
 * @property string $button
 *
 * @property User $passedBy
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
            [['question_id', 'is_correct', 'quiz_id', 'passed_by', 'current_question'], 'integer'],
            [['selected_answer', 'button'], 'string', 'max' => 255],
            [['passed_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['passed_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'selected_answer' => 'Selected Answer',
            'question_id' => 'Question ID',
            'is_correct' => 'Is Correct',
            'quiz_id' => 'Quiz ID',
            'passed_by' => 'Passed By',
            'current_question' => 'Current Question',
            'button' => 'Button',
        ];
    }

    public function insertData($selected, $questionId, $quizId, $isCorrect, $currentQuestion, $button)
    {
        $progress = new Progress();
        $progress->selected_answer = $selected;
        $progress->question_id = $questionId;
        $progress->quiz_id = $quizId;
        $progress->is_correct = $isCorrect;
        $progress->current_question = $currentQuestion;
        $progress->button = $button;
        $progress->save();

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPassedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'passed_by']);
    }
}
