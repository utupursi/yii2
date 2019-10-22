<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%question}}`.
 */
class m191022_093114_add_foreign_key_column_to_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-question-updated_by',
            'question',
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
    }
}
