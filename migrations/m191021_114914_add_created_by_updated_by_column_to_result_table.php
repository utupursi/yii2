<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%result}}`.
 */
class m191021_114914_add_created_by_updated_by_column_to_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('result', 'created_by', $this->integer());
        $this->addColumn('result', 'updated_by', $this->integer());
        $this->addForeignKey(
            'fk-result-created_by',
            'result',
            'created_by',
            'user',
            'id',
            'SET NULL'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
