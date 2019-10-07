<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property string $code
 * @property string $name
 * @property string $surname
 */
class Person2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name', 'surname'], 'required'],
            [['code'], 'string', 'max' => 2],
            [['name', 'surname'], 'string', 'max' => 52],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }
}
