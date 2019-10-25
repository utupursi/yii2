<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "result".
 *
 * @property int $id
 * @property string $quiz_name
 * @property int $min_correct
 * @property int $correct_answer_count
 * @property int $number_of_questions
 * @property int $quiz_pass_date
 * @property int $created_by
 * @property int $certificate_valid_time
 *
 * @property User $createdBy
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'result';
    }

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_correct', 'correct_answer_count', 'number_of_questions', 'quiz_pass_date', 'created_by'], 'integer'],
            [['certificate_valid_time'],'safe'],
            [['quiz_name'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quiz_name' => 'Quiz Name',
            'min_correct' => 'Min Correct',
            'correct_answer_count' => 'Correct Answer Count',
            'number_of_questions' => 'Number Of Questions',
            'quiz_pass_date' => 'Quiz Pass Date',
            'created_by' => 'Created By',
            'certificate_valid_time' => 'Certificate Valid Time',
        ];
    }

    public function insertResult($minCorrect, $subject, $count, $countFromTable, $validTime)
    {
        $result = new Result();
        $result->min_correct = $minCorrect;
        $result->created_by = Yii::$app->user->identity->id;
        $result->quiz_name = $subject;
        $result->correct_answer_count = $count;
        $result->number_of_questions = $countFromTable;
        $date = date('Y-m-d H:i:s');
        $date = strtotime(date("Y-m-d H:i:s", strtotime($date)) . '+' . $validTime . 'month');
        if ($minCorrect <= $count) {
            $result->certificate_valid_time = date('Y-m-d H:i:s', $date);
        }
        return $result->save();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}
