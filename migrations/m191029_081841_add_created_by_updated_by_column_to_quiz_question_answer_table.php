<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quiz_question_answer}}`.
 */
class m191029_081841_add_created_by_updated_by_column_to_quiz_question_answer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //add created by and updated by to quiz table

        $this->addColumn('quiz', 'created_by', $this->integer());
        $this->addColumn('quiz', 'updated_by', $this->integer());
        $this->addForeignKey(
            'fk-quiz-created_by',
            'quiz',
            'created_by',
            'user',
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
        //add created by and updated by column to question table

        $this->addColumn('question', 'created_by', $this->integer());
        $this->addColumn('question', 'updated_by', $this->integer());

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


        //add created by and updated by column to answer table

        $this->addColumn('answer', 'created_by', $this->integer());
        $this->addColumn('answer', 'updated_by', $this->integer());

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


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        //drop updated by and created by column from quiz table

        $this->dropColumn('quiz', 'created_by');
        $this->dropColumn('quiz', 'updated_by');
        $this->dropForeignKey(
            'fk-quiz-created_by',
            'quiz'
        );
        $this->dropForeignKey(
            'fk-quiz-updated_by',
            'quiz'
        );

        //drop updated by and created by column from question table

        $this->dropColumn('question', 'created_by');
        $this->dropColumn('question', 'updated_by');

        $this->dropForeignKey(
            'fk-question-created_by',
            'question'
        );
        $this->dropForeignKey(
            'fk-question-updated_by',
            'question'
        );


        //drop updated by and created by column from answer table

        $this->dropColumn('answer', 'created_by');
        $this->dropColumn('answer', 'updated_by');

        $this->dropForeignKey(
            'fk-answer-created_by',
            'answer'
        );
        $this->dropForeignKey(
            'fk-answer-updated_by',
            'answer'
        );

    }
}
