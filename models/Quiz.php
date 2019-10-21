<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\validators\UniqueValidator;

/**
 * This is the model class for table "quiz".
 *
 * @property int $id
 * @property int $min_correct
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int $max_question
 * @property string $subject
 * @property Question[] $questions
 */
class Quiz extends \yii\db\ActiveRecord
{


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
            [['min_correct', 'created_at', 'updated_at', 'max_question', 'created_by', 'updated_by'], 'integer'],
            [['subject'], 'string', 'max' => 255],
            [['subject'], 'unique'],
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
            'created_by' => 'Created by',
            'updated_by' => 'Updated by',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['quiz_id' => 'id']);
    }
}
