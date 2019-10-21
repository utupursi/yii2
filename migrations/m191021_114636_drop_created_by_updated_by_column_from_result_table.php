<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%result}}`.
 */
class m191021_114636_drop_created_by_updated_by_column_from_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('result', 'created_by');
        $this->dropColumn('result', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
