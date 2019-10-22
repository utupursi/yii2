<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuizSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Quizzes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Quiz', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subject',
            'min_correct',
            'created_at:datetime',
            'updated_at:datetime',
            'max_question',

            ['label' => 'Created By',
                'value' => function ($model) {
                    return $model->createdBy['username'];
                }
            ],

            ['label' => 'Updated By',
                'value' => function ($model) {
                    return $model->updatedBy['username'];
                }
            ],
            //'subject',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
