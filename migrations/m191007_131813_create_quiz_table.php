<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%quiz}}`.
 */
class m191007_131813_create_quiz_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%quiz}}', [
            'id' => $this->primaryKey(),
            'min_correct'=> $this->integer(2),
            'created_at'=>$this->integer(11),
            'updated_at'=>$this->integer(11),
            'max_question'=>$this->integer(2)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%quiz}}');
    }
}
