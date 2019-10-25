<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%result}}`.
 */
class m191025_072834_drop_quiz_id_updated_by_column_from_result_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey(
            'fk-result-updated_by',
            'result'
        );
        $this->dropForeignKey(
            'fk-result-quiz_id',
            'result'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
