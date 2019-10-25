<?php

namespace app\controllers;

use app\models\Answer;
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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

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
                'only' => ['index', 'update', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'update', 'view'],
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
        $searchModel = new QuizSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionQuiz($id)
    {
        $modelResult = new Result();

        $quiz = Quiz::findOne($id);

        $questions = Question::find()
            ->where(['quiz_id' => $id])
            ->with(['answers'])
            ->all();

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $count = 0;
            $questionCount = 0;
            $answerIds = [];

            foreach ($post as $index => $answerId) {
                if (strpos($index, 'selectedAnswer') !== false) {
                    $questionCount++;
                    $answerIds[] = $answerId;
                }
            }

            $answers = Answer::find()
                ->andWhere(['id' => $answerIds])
                ->all();

            foreach ($answers as $answer) {
                if ($answer->is_correct) {
                    $count++;
                }
            }

            $error = $count < $quiz->min_correct ? 'You have  not  passed quiz' : '';
            $success = $count < $quiz->min_correct ? '' : 'You have successfully passed quiz';

            $questionCountFromDb = Question::find()
                ->where(['quiz_id' => $id])
                ->count();


            if ($questionCount != $questionCountFromDb) {
                $errorOfChoose = 'You should answer to all questions';
                return $this->render('quiz_template', [
                    'questions' => $questions,
                    'quiz' => $quiz,
                    'errorOfChoose' => $errorOfChoose,
                ]);

            }
            if (!$modelResult->insertResult($quiz->min_correct, $quiz->subject, $count, $questionCountFromDb, $quiz->certificate_valid_time)) {
                $errorOfInsert = 'Can not insert data in result';
                return $this->render('quiz_template', [
                    'questions' => $questions,
                    'quiz' => $quiz,
                    'errorOfInsert' => $errorOfInsert,
                ]);
            } else {
                return $this->render('quiz_finish', [
                    'count' => $count,
                    'error' => $error,
                    'success' => $success,
                    'question_count' => $questionCount,
                    'id' => $id,
                ]);
            }
        }


        return $this->render('quiz_template', [
            'questions' => $questions,
            'quiz' => $quiz,
        ]);

    }


    public function actionResult()
    {
        $searchModel = new ResultSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('result_reporting', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Quiz model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search1(Yii::$app->request->queryParams, $id);


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
    public function actionCreate()
    {
        $model = new Quiz();

        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->min_correct <= $model->max_question) {

            return $this->redirect(['view', 'id' => $model->id]);
        }
        if (Yii::$app->request->isPost) {
            $error = 'Minimal correct answer can not be more than maximal number of questions';
        } else {
            $error = '';
        }

        return $this->render('create', [
            'model' => $model,
            'error' => $error,
        ]);
    }

    /**
     * Updates an existing Quiz model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
    public function actionDelete($id)
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
    protected function findModel($id)
    {
        if (($model = Quiz::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
