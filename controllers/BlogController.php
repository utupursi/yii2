<?php

namespace app\controllers;

use app\models\Answer;
use app\models\AnswerSearch;
use app\models\Blog;
use Symfony\Component\Yaml\Tests\B;
use Yii;
use app\models\Quiz;
use app\models\Question;
use app\models\QuestionSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class BlogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'update', 'view', 'create'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionBlog()
    {
        $blog = Blog::find()->all();

        return $this->render('blog', [
            'blogs' => $blog
        ]);
    }

    public function actionBlogDetails($id)
    {
        $blog = Blog::find()->where(['id' => $id])->one();
        if (!$blog) {
            throw new NotFoundHttpException('Blog Not Found');
        }

        return $this->render('blogDetails', [
            'blog' => $blog
        ]);
    }

    public function actionCreate()
    {
        $model = new Blog();
        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'image');
            $path = Yii::getAlias('@webroot') . '/Files/';
            if ($model->imageFile) {
                $model->image = $model->imageFile->baseName . '.' . $model->imageFile->extension;
            }
            if ($model->save()) {
                if ($model->imageFile) {
                    $model->imageFile->saveAs($path . $model->imageFile->baseName . '.' . $model->imageFile->extension);
                }
                return $this->redirect(['blog']);
            }

            throw new ServerErrorHttpException('can not save');
        }

        return $this->render('createBlog', [
            'model' => $model,
        ]);
    }

    public function actionViewUserBlog()
    {
        $userBlogs = Blog::find()->where(['created_by' => Yii::$app->user->id])->all();

        return $this->render('viewBlogs', [
            'blogs' => $userBlogs,
        ]);
    }

    public function actionUpdateBlog($id)
    {

        $model = Blog::findOne($id);
        if ($model) {
            $image = $model->image;
            if (Yii::$app->user->id === $model->created_by) {
                if ($model->load(Yii::$app->request->post())) {
                    $model->imageFile = UploadedFile::getInstance($model, 'image');
                    $path = Yii::getAlias('@webroot') . '/Files/';
                    if ($model->imageFile) {
                        $model->image = $model->imageFile->baseName . '.' . $model->imageFile->extension;
                    }
                    if (!$model->imageFile && $image !== '') {
                        unlink($path . $image);
                    }
                    if (!$model->save()) {
                        throw new ServerErrorHttpException('can not update');
                    }
                    if ($model->imageFile) {
                        $model->imageFile->saveAs($path . $model->imageFile->baseName . '.' . $model->imageFile->extension);
                    }
                    return $this->redirect(['blog']);
                }
                return $this->render('editBlog', [
                    'model' => $model
                ]);
            }
        }
        throw new ForbiddenHttpException('You don not have permission ');
    }

    public function actionDeleteBlog($id)
    {
        $model = Blog::findOne($id);
        $userBlogs = Blog::find()->where(['created_by' => Yii::$app->user->id])->all();
        if ($model)
            if (!$model->delete()) {
                throw new ServerErrorHttpException('can not delete');
            }
        return $this->render('viewBlogs', [
            'blogs' => $userBlogs
        ]);
    }
}
