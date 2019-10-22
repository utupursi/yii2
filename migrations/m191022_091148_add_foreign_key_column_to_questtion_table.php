<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%questtion}}`.
 */
class m191022_091148_add_foreign_key_column_to_questtion_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-question-created_by',
            'question',
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
