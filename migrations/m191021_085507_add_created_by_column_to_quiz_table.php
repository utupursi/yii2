<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quiz}}`.
 */
class m191021_085507_add_created_by_column_to_quiz_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('quiz', 'created_by', $this->integer());
        $this->addColumn('quiz', 'updated_by', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
