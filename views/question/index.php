<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\Request;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'quiz_id',
            'name',
            'hint',
            'max_ans',
            'created_at:datetime',
            'updated_at:datetime',
            ['label' => 'Created By',
                'value' => function ($model) {
                    return $model->createdBy->username;
                }
            ],
            ['label' => 'Updated By',
                'value'=>function($model){
                    return $model->updatedBy->username;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],

    ]); ?>


</div>

