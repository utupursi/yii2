<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%blog}}`.
 */
class m200128_120741_add_text_column_to_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('blog', 'text');

        $this->addColumn('blog', 'text', $this->text());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('blog', 'text');

        $this->addColumn('blog', 'text', $this->text());
    }
}
