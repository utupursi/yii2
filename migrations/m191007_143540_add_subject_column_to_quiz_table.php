<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quiz}}`.
 */
class m191007_143540_add_subject_column_to_quiz_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quiz}}', 'subject', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quiz}}', 'subject');
    }
}
