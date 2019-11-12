<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%progress}}`.
 */
class m191112_084828_drop_selected_answer_button_column_from_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('progress', 'selected_answer');
        $this->dropColumn('progress', 'button');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('progress', 'selected_answer', $this->string());
        $this->addColumn('progress', 'button', $this->string());
    }
}
