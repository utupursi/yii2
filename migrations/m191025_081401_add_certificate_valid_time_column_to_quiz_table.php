<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quiz}}`.
 */
class m191025_081401_add_certificate_valid_time_column_to_quiz_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('quiz', 'certificate_valid_time', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
