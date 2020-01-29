<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog}}`.
 */
class m200120_142027_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog}}', [
            'id' => $this->primaryKey(),
            'header' => $this->string(),
            'text' => $this->string(),
            'image' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),

        ]);
        $this->addForeignKey(
            'fk-blog-created_by',
            'blog',
            'created_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addForeignKey(
            'fk-blog-updated_by',
            'blog',
            'updated_by',
            'user',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%blog}}');
    }
}
