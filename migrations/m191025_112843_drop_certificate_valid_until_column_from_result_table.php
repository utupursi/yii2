<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%result}}`.
 */
class m191025_112843_drop_certificate_valid_until_column_from_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('result', 'certificate_valid_time');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
