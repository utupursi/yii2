<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%answer}}`.
 */
class m191008_070828_create_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%answer}}', [
            'id' => $this->primaryKey(),
            'question_id'=>$this->integer(),
            'is_correct'=>$this->boolean(0),
            'name'=>$this->string(255),
            'created_at'=>$this->integer(11),
            'updated_at'=>$this->integer(11),

        ]);
        $this->addForeignKey(
            'fk-answer-question_id',
            'answer',
            'question_id',
            'question',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%answer}}');
    }
}
