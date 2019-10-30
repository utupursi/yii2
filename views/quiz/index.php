<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

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
        'headerRowOptions' =>
            [
                'style' => 'background-color:yellow; color:#0a73bb',
            ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'subject',
            'min_correct',
            ['label' => 'Created At',
                'attribute' => 'created_at',
                'value' => 'created_at',
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'clientOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-m-d'
                    ]
                ]),

            ],

            'updated_at:datetime',
            ['label' => 'max_question',
                'value' => 'max_question'
            ],


            ['label' => 'Created By',
                'value' => function ($model) {
                    return $model->createdBy->username;
                }
            ],

            ['label' => 'Updated By',
                'value' => function ($model) {
                    return $model->updated_by ? $model->updatedBy->username : '';
                }
            ],
            //'subject',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
