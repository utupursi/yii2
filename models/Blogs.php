<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blogs".
 *
 * @property int $id
 * @property string $blog_header
 * @property string $blog_body
 * @property string $category
 * @property int $created_by
 * @property string $created_at
 * @property string $photo
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'blogs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blog_header'], 'required'],
            [['blog_body'], 'string'],
            [['created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['file'],'file'],
            [['blog_header', 'category'], 'string', 'max' => 15],
            [['photo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog_header' => 'Blog Header',
            'blog_body' => 'Blog Body',
            'category' => 'Category',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'file' => 'Photo',
        ];
    }
}
