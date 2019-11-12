<?php

namespace app\controllers;

use app\models\Answer;
use app\models\Progress;
use app\models\Question;
use app\models\Result;
use app\models\ResultSearch;
use Yii;
use app\models\Quiz;
use yii\data\Pagination;
use app\models\QuizSearch;
use app\models\QuestionSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * QuizController implements the CRUD actions for Quiz model.
 */
class QuizController extends Controller
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
     * Lists all Quiz models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Quiz();
        $searchModel = new QuizSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }


    public function actionPreviousselected()
    {
        $quiz = new Quiz();
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $data = Yii::$app->request->post();
                if ($quiz->previousAjax($data) === false) {
                    return json_encode('error of insert');
                } else {
                    return $quiz->previousAjax($data);
                }
            }

        }
    }

    public function actionNextselected()
    {

        $quiz = new Quiz();
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $data = Yii::$app->request->post();
                if ($quiz->nextAjax($data) === false) {
                    return json_encode('error of insert');
                } else {
                    return $quiz->nextAjax($data);
                }

            }
        }

    }

    public function actionFinish($id)
    {
        $quiz = new Quiz();
        $quiz->countCorrectAnswers($id);
        $progress = new Progress();

        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $data = Yii::$app->request->post();
                if ($quiz->finishAjax($data, $id) === false) {
                    return json_encode('error of insert');
                } else {
                    return $quiz->finishAjax($data, $id);
                }

            }
        }
        $quiz->insertData();
        $progress->deleteALL(['quiz_id' => $id, 'passed_by' => Yii::$app->user->identity->id]);
        return $this->render('quiz_finish', [
            'count' => $quiz->count,
            'error' => $quiz->error,
            'success' => $quiz->success,
            'question_count' => $quiz->questionCountFromDb,
            'id' => $id,
        ]);

    }

    public
    function actionQuiz($id)
    {
        $quiz = new Quiz();
        $progress = new Progress();
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $data = Yii::$app->request->post();
                $array = [];
                foreach ($data['answers'] as $answer) {
                    $array[] = $answer['id'];
                }
                $name = $progress->find()->andwhere(['selected_answer' => $array])->andWhere(['passed_by' => Yii::$app->user->identity->id])->count();
                if ($name > 0) {
                    return json_encode($progress->find()->where(['selected_answer' => $array])->asArray()->one());
                }
            }
            $arr = [];
            $arr[0] = $quiz->getQuestion($id);
            $arr[1] = $progress->find()->orderBy(['id' => SORT_DESC])
                ->andwhere(['quiz_id' => $id])
                ->andWhere(['passed_by' => Yii::$app->user->identity->id])
                ->asArray()
                ->one();
            return json_encode($arr);
        }
        if ($quiz->errorOfStartQuiz($id) === true) {
            $errorOfStartQuiz = 'You can not start quiz until you have uncompleted quiz';
            return $this->render('start_quiz', [
                'searchModel' => $quiz->searchModel,
                'dataProvider' => $quiz->dataProvider,
                'errorOfStartQuiz' => $errorOfStartQuiz,
                'arrayOfQuizId' => $quiz->progressQuizId(),
            ]);
        }

        if ($quiz->errorOfQuiz($id) === true) {
            $errorOfQuiz = 'You can not pass quiz,quiz does not have questions';
            return $this->render('start_quiz', [
                'searchModel' => $quiz->searchModel,
                'dataProvider' => $quiz->dataProvider,
                'errorOfQuiz' => $errorOfQuiz,
                'arrayOfQuizId' => $quiz->progressQuizId(),
            ]);
        }
        if ($quiz->errorOfAnswers() === true) {
            $errorOfAnswer = 'You can not pass quiz,some questions  does not have enough number of answers';
            return $this->render('start_quiz', [
                'searchModel' => $quiz->searchModel,
                'dataProvider' => $quiz->dataProvider,
                'errorOfAnswer' => $errorOfAnswer,
                'arrayOfQuizId' => $quiz->progressQuizId(),
            ]);

        }
        if ($quiz->errorOfCorrectAnswers() === true) {
            $errorOfCorrectAnswers = 'Some questions does not have correct answers';
            return $this->render('start_quiz', [
                'searchModel' => $quiz->searchModel,
                'dataProvider' => $quiz->dataProvider,
                'errorOfCorrectAnswers' => $errorOfCorrectAnswers,
                'arrayOfQuizId' => $quiz->progressQuizId(),
            ]);

        }
        if ($quiz->errorNumberOfQuestion($id) === true) {
            $errorNumberOfQuestion = 'Number of questions less than minimal correct answers ';
            return $this->render('start_quiz', [
                'searchModel' => $quiz->searchModel,
                'dataProvider' => $quiz->dataProvider,
                'errorOfCorrectAnswers' => $errorNumberOfQuestion,
                'arrayOfQuizId' => $quiz->progressQuizId(),
            ]);
        } else {
            return $this->render('quiz_template', [
                'questions' => $quiz->getQuestion($id),
                'quiz' => $quiz->getQuiz($id),
            ]);
        }

    }


    public
    function actionResult()
    {
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('result_reporting', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public
    function actionStart()
    {
        $quiz = new Quiz();
        $searchModel = new QuizSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('start_quiz', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'errorOfQuiz' => '',
            'arrayOfQuizId' => $quiz->progressQuizId(),
        ]);
    }

    /**
     * Displays a single Quiz model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionView($id)
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Creates a new Quiz model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreate()
    {
        $model = new Quiz();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->min_correct <= $model->max_question) {

            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
            'dropDownListItems' => $model->dropDownListItem(),
        ]);
    }

    /**
     * Updates an existing Quiz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Quiz model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public
    function actionDelete($id)
    {

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Quiz model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Quiz the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Quiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
