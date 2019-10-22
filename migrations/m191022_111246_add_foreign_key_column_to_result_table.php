<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%result}}`.
 */
class m191022_111246_add_foreign_key_column_to_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-result-updated_by',
            'result',
            'updated_by',
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
