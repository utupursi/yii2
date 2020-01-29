<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%blog}}`.
 */
class m200128_074012_add_category_link_column_to_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('blog', 'category', $this->string());
        $this->addColumn('blog', 'link', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('blog', 'category');
        $this->dropColumn('blog', 'link');
    }
}
