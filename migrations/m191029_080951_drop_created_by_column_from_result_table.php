<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%result}}`.
 */
class m191029_080951_drop_created_by_column_from_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-result-created_by',
            'result'
        );
        $this->dropColumn('result', 'created_by');
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addForeignKey(
            'fk-result-created_by',
            'result',
            'created_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addColumn('result', 'created_by', $this->integer());

    }
}
