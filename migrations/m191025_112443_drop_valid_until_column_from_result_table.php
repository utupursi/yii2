<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%result}}`.
 */
class m191025_112443_drop_valid_until_column_from_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('result', 'valid_until');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
