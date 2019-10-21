<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%answer}}`.
 */
class m191021_090236_add_created_by_updated_by_column_to_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('answer', 'created_by', $this->integer());
        $this->addColumn('answer', 'updated_by', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
