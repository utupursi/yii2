<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Quiz */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['quiz/view', 'id' => $model->quiz_id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quiz-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            'name',
            'max_ans',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
    <h3>Answers</h3>
    <?= Html::a('Create Answer', ['answer/create', 'questionId' => $model->id], ['class' => 'btn btn-success']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['label' => 'Question',
                'value' => function ($model) {
                    return $model->question->name;
                }
            ],
            'is_correct',
            'name',
            ['label' => 'Created At',
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at);

                },
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                    'clientOptions' => [
                        'format' => 'yyyy-m-dd',
                        'todayHighlight' => true
                    ]
                ]),
            ],

            ['filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'updated_at',
                'clientOptions' => [
                    'format' => 'yyyy-m-dd',
                    'todayHighlight' => true
                ]
            ]),

                'label' => 'Updated At',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at);
                }
            ],
            //'subject',
            ['label' => 'Created By',
                'value' => function ($model) {
                    return $model->createdBy->username;
                }
            ],
            ['label' => 'Updated By',
                'value' => function ($model) {
                    return $model->updatedBy->username;
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model) {
                    return "/answer/$action?id=" . $model->id;
                },
            ],
        ],
    ]); ?>

</div>
