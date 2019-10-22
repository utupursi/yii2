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
        $query = Question::find();

        $model_result = new  Result();

        $quiz = Quiz::findOne($id);

        if (Yii::$app->request->post()) {

            $responses = Yii::$app->request->post();

            $count = 0;
            $question_count = 0;

            foreach ($responses as $index => $response) {
                $question_count++;
                if (strpos($index, 'selectedAnswer') !== false) {

                    $answer = Answer::findOne($response);

                    if ($answer->is_correct == 1) {
                        $count += 1;
                    }

                }

            }


            if ($count < $quiz->min_correct) {
                $error = 'You have  not  passed quiz';
                $success = '';
            } else {
                $error = '';
                $success = 'You have successfully passed quiz';
            }

            $question_count_fromTable = $query->where(['quiz_id' => $id])->count();

            $model_result->insert_result($id, $quiz->min_correct, $count, $question_count_fromTable);

            if ($question_count - 1 == $question_count_fromTable) {
                return $this->render('quiz_finish', [
                    'count' => $count,
                    'error' => $error,
                    'success' => $success,
                    'question_count' => $question_count - 1,
                    'id' => $id,
                ]);
            }
        }

        $questions = $query->where(['quiz_id' => $id])->all();

        $i = 0;
        foreach ($questions as $question) {
            $answers[$i] = Answer::find()
                ->where(['question_id' => $question->id])
                ->all();
            $i++;
        }

        return $this->render('quiz_template', [
            'questions' => $questions,
            'answers' => $answers,
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
        $quiz = new Quiz();

        $search = $quiz->findOne($id);
        $model = new Result();

        $model->updateAll(['quiz_name' => $search->subject], ['quiz_id' => $id]);

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
