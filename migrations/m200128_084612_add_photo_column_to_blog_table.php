<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%blog}}`.
 */
class m200128_084612_add_photo_column_to_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('blog', 'photo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('blog', 'photo');

    }
}
