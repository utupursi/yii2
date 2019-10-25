<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%result}}`.
 */
class m191025_073331_drop_quiz_id_updated_by_column_from_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('result', 'quiz_id');
        $this->dropColumn('result', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
