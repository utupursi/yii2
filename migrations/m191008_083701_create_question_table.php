<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%question}}`.
 */
class m191008_083701_create_question_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%question}}', [
            'id' => $this->primaryKey(),
            'quiz_id'=>$this->integer(),
            'name'=>$this->STRING(255),
            'hint'=>$this->string(255),
            'max_ans'=>$this->integer(2),
            'created_at'=>$this->integer(11),
            'updated_at'=>$this->integer(11),
        ]);
        $this->addForeignKey(
            'fk-question-quiz_id',
            'question',
            'quiz_id',
            'quiz',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%question}}');
    }
}
