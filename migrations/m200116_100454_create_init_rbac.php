<?php

use yii\db\Migration;

/**
 * Class m200116_094739_create_init_rbac
 */
class m200116_100454_create_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $creatQuiz = $auth->createPermission('createQuiz');
        $creatQuiz->description = 'Create a Quiz';
        $auth->add($creatQuiz);


        $viewQuiz = $auth->createPermission('viewQuiz');
        $viewQuiz->description = 'View a Quiz';
        $auth->add($viewQuiz);

        $updateQuiz = $auth->createPermission('updateQuiz');
        $updateQuiz->description = 'Update a Quiz';
        $auth->add($updateQuiz);

        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $creatQuiz);
        $auth->addChild($author, $viewQuiz);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateQuiz);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $viewQuiz);

        $auth->assign($author, 2);
        $auth->assign($admin, 1);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200116_094739_create_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
