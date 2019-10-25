<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%result}}`.
 */
class m191025_100213_add_valid_until_column_to_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('result', 'valid_until', $this->dateTime());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
