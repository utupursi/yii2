<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%result}}`.
 */
class m191018_135620_create_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%result}}', [
            'id' => $this->primaryKey(),
            'quiz_id' => $this->integer(),
            'min_correct' => $this->integer(2),
            'correct_answer_count' => $this->integer(2),
            'number_of_questions' => $this->integer(2),
            'quiz_pass_date' => $this->integer(11)
        ]);
        $this->addForeignKey(
            'fk-result-quiz_id',
            'result',
            'quiz_id',
            'quiz',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%result}}');
    }
}
