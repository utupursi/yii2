<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%result}}`.
 */
class m191025_112947_add_certificate_valid_until_column_to_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('result', 'certificate_valid_time', $this->dateTime());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
