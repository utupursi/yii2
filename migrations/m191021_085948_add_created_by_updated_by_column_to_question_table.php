<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%question}}`.
 */
class m191021_085948_add_created_by_updated_by_column_to_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('question', 'created_by', $this->integer());
        $this->addColumn('question', 'updated_by', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
