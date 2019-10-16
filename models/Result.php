<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "result".
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $min_correct
 * @property int $correct_answer_count
 * @property int $quiz_pass_date
 */
class Result extends \yii\db\ActiveRecord
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['quiz_pass_date'],

                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function tableName()
    {
        return 'result';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quiz_id', 'min_correct', 'correct_answer_count', 'quiz_pass_date'], 'integer'],
        ];
    }

    public function insert_result($id, $min_correct, $count)
    {
        $result = new Result();
        $result->quiz_id=$id;
        $result->min_correct = $min_correct;
        $result->correct_answer_count = $count;

        if ($result->save()) {
            return true;
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quiz_id' => 'Quiz ID',
            'min_correct' => 'Min Correct',
            'correct_answer_count' => 'Correct Answer Count',
            'quiz_pass_date' => 'Quiz Pass Date',
        ];
    }
}
