<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%progress}}`.
 */
class m191113_152611_add_quiz_start_date_column_to_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('progress', 'quiz_start_date', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('progress', 'quiz_start_date');
    }
}
