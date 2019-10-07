<?php

namespace app\controllers;

use app\models\Person2;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use app\models\Blogs;
use app\models\User1;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            [
            'class'=>AccessControl::className(),
            'only'=>['blogs'],
            'rules'=>[
                [
                    'actions'=>['blogs'],
                    'allow'=>true,
                    'roles'=>['@']
                ],
            ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       $user=new User1;
//        $user->on(User1::USER_REGISTERED, function($event){
//           echo $event->name;
//        });
//
//        $user->on(User1::USER_REGISTERED,[$user,'method']);
//
//        $user->on(User1::USER_REGISTERED,function($event) {
//          echo 't';
//        });
//            $user->trigger(User1::USER_REGISTERED);
    echo $user->property1;
    echo $user->property2;
    echo $user->foo();
      die;

        return $this->render('index');

    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Hello')
    {
        return $this->render('say', ['message' => $message]);
    }


    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry',['model'=>$model]);
        }
    }
    public function actionForm(){
        $model = new Person2();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно провере
            // делаем что-то полезное с $model ..
            if($model->save()) {
                return $this->render('index', ['model' => $model]);
            }
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('form', ['model' => $model]);
        }
    }

    public function actionSignup(){
       $model=new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

         return $this->redirect(Yii::$app->homeUrl);
        }
        else {
            return $this->render('signup', ['model' => $model]);
        }
    }
/*    public function actionBlogs(){
        $model=new Blogs();
        if ($model->load(Yii::$app->request->post())){
               if($model->save()){
                   return $this->redirect(Yii::$app->homeUrl);
               }
        }
        return $this->render('blogs',['model'=>$model]);
    }*/
    public function actionBlogs1(){
        $model=new Blogs();
        $blogs=$model::find()->all();
        return $this->render('index',['blogs'=>$blogs]);
    }
    public function actionDownload(){
        $path=Yii::getAlias('@webroot') . '/Files';
        $file=$path . '/9.php';
        if(file_exists($file)){
            Yii::$app->response->xSendFile($file);
        }
        else{
            $this->render('index');
        }
    }
    public function actionUpload()
    {
        $model = new Blogs();
        if ($model->load(Yii::$app->request->post())) {
            $imageName = rand(1, 100000);
            $model->file = UploadedFile::getInstance($model, 'file');
            $path=Yii::getAlias('@webroot') . '/Files/';
            $model->file->saveAs($path . $imageName . '.' . $model->file->extension);
            $model->photo = $imageName . '.' . $model->file->extension;
            if($model->save()) {
                return $this->redirect(Yii::$app->homeUrl);
            }
        }
        else{
            return $this->render('blogs',['model'=>$model]);
        }

    }
}
