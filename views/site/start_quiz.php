<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuizSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'headerRowOptions' => ['style' => 'background-color:#00FF7F'],
'options'=>['style'=>'width:800px'],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',],
        ['label' => 'Subject',
            'value' => function ($model) {
                return $model->subject;
            },
            'contentOptions' => ['width:30px']
        ],

        ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
            'buttons' => [
                'view' => function ($url) {
                    return Html::a('<span class="btn btn-success">Start</span>', $url);

                },

            ],
            'urlCreator' => function ($action, $model) {
                if ($action === 'view') {
                    $url = '/quiz/quiz?id=' . $model->id;
                    return $url;
                };
            },
            'contentOptions' => ['style' => 'width:10px']
        ],

    ],


]); ?>