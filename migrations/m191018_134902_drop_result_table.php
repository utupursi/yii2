<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%result}}`.
 */
class m191018_134902_drop_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%result}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
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
            'id'
        );
    }
}
