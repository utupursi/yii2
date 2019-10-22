<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%answer}}`.
 */
class m191022_091241_add_foreign_key_column_to_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-answer-created_by',
            'answer',
            'created_by',
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
    }
}
