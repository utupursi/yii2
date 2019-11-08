<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%progress}}`.
 */
class m191108_140100_add_current_question_column_to_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('progress', 'current_question', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('progress', 'current_question');
        
    }
    
}
