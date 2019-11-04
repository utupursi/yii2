<?php

namespace app\models;

use phpDocumentor\Reflection\DocBlock\Tags\Param;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\widgets\ActiveForm;

/**
 * This is the model class for table "answer".
 *
 * @property int $id
 * @property int $question_id
 * @property int $is_correct
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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

    public static function tableName()
    {
        return 'answer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'is_correct', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['name'], 'required'],
            ['is_correct', 'countCorrectAnswers'],
            ['is_correct', 'countIncorrectAnswers', 'on' => 'create']
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
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'Created_by' => 'Created By',
            'Updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function countCorrectAnswers($attribute)
    {
        $answers = Answer::find()->where(['question_id' => $this->question_id])->all();
        $count = 0;
        if ($this->is_correct == 1) {

            foreach ($answers as $answer) {

                if ($answer['is_correct'] == 1 && $answer['name'] != $this->name) {

                    $this->addError($attribute, 'Correct answer is already exist');
                }
            }
        }
    }

    public function countIncorrectAnswers($attribute)
    {
        $questions = Question::findOne(['id' => $this->question_id]);
        $answerCount = Answer::find()->where(['question_id' => $this->question_id])->count();
        $searchCorrectAnswer = Answer::find()->where(['question_id' => $this->question_id, 'is_correct' => true])->count();

        if ($this->is_correct == 0 && $searchCorrectAnswer == 0 && $answerCount == $questions->max_ans - 1) {
            $this->addError($attribute, 'Can not be without correct answer');
        }

    }

    public function errorCountNumberOfAnswers($model, $questionId)
    {
        $count = Answer::find()->where(['question_id' => $questionId])->count();
        $question = Question::findOne($questionId);

        if (($question->max_ans) > $count) {
            return false;

        }
    }

    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

}
