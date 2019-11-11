<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%progress}}`.
 */
class m191111_071916_add_button_column_to_progress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('progress', 'button', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('progress', 'button');

    }
}
