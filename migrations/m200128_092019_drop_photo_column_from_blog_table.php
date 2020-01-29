<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%blog}}`.
 */
class m200128_092019_drop_photo_column_from_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('blog', 'photo');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('blog', 'photo', $this->string());
    }
}
