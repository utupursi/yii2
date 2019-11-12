<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%progress}}`.
 */
class m191112_085202_add_selected_answer_column_to_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('progress', 'selected_answer', $this->integer());
        $this->addForeignKey(
            'fk-progress-selected_answer',
            'progress',
            'selected_answer',
            'answer',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('progress', 'selected_answer');
    }
}
