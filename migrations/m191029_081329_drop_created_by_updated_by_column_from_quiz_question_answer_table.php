<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%quiz_question_answer}}`.
 */
class m191029_081329_drop_created_by_updated_by_column_from_quiz_question_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //drop updated by and created by column from quiz table
        $this->dropForeignKey(
            'fk-quiz-created_by',
            'quiz'
        );
        $this->dropForeignKey(
            'fk-quiz-updated_by',
            'quiz'
        );
        $this->dropColumn('quiz', 'created_by');
        $this->dropColumn('quiz', 'updated_by');

        //drop updated by and created by column from question table
        $this->dropForeignKey(
            'fk-question-created_by',
            'question'
        );
        $this->dropForeignKey(
            'fk-question-updated_by',
            'question'
        );
        $this->dropColumn('question', 'created_by');
        $this->dropColumn('question', 'updated_by');

        //drop updated by and created by column from answer table
        $this->dropForeignKey(
            'fk-answer-created_by',
            'answer'
        );
        $this->dropForeignKey(
            'fk-answer-updated_by',
            'answer'
        );
        $this->dropColumn('answer', 'created_by');
        $this->dropColumn('answer', 'updated_by');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //add created by and updated by to quiz table
        $this->addForeignKey(
            'fk-quiz-created_by',
            'quiz',
            'created_by',
            'users',
            'id',
            'SET NULL'
        );
        $this->addForeignKey(
            'fk-quiz-updated_by',
            'quiz',
            'updated_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addColumn('quiz', 'created_by', $this->integer());
        $this->addColumn('quiz', 'updated_by', $this->integer());

        //add created by and updated by column to question table
        $this->addForeignKey(
            'fk-question-created_by',
            'question',
            'created_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addForeignKey(
            'fk-question-updated_by',
            'question',
            'updated_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addColumn('question', 'created_by', $this->integer());
        $this->addColumn('question', 'updated_by', $this->integer());


        //add created by and updated by column to question table
        $this->addForeignKey(
            'fk-answer-created_by',
            'answer',
            'created_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addForeignKey(
            'fk-answer-updated_by',
            'answer',
            'updated_by',
            'user',
            'id',
            'SET NULL'
        );
        $this->addColumn('answer', 'created_by', $this->integer());
        $this->addColumn('answer', 'updated_by', $this->integer());
    }
}
