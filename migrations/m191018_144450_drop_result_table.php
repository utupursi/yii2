<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%result}}`.
 */
class m191018_144450_drop_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%result}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%result}}', [
            'id' => $this->primaryKey(),
        ]);
    }
}
