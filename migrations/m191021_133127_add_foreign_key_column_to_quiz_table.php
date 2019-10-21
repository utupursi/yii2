<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quiz}}`.
 */
class m191021_133127_add_foreign_key_column_to_quiz_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-quiz-created_by',
            'quiz',
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
