<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%progress}}`.
 */
class m191108_103127_create_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%progress}}', [
            'id' => $this->primaryKey(),
            'selected_answer' => $this->string(),
            'question_id' => $this->integer(11),
            'is_correct' => $this->tinyInteger(1),
            'quiz_id' => $this->integer(11),
            'passed_by' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk-progress-passed_by',
            'progress',
            'passed_by',
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
        $this->dropTable('{{%progress}}');
    }
}
