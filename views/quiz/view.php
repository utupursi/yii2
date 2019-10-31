<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Quiz */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Quizzes', 'url' => ['index']];
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
            'min_correct',
            'created_at:datetime',
            'updated_at:datetime',
            'max_question',
            'subject',
        ],
    ]) ?>


    <h3>Questions</h3>
    <?= Html::a('Create Question', ['question/create', 'quizId' => $model->id], ['class' => 'btn btn-success']) ?>
    <?php $r = $model->id ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'hint',
            'max_ans',
            ['label' => 'Created At',
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->created_at);

                },
                'format' => 'raw',
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'created_at',

                ]),
            ],

            ['filter' => DatePicker::widget([
                'model' => $searchModel,
                'attribute' => 'updated_at',
            ]),

                'label' => 'Updated At',
                'value' => function ($model) {
                    return Yii::$app->formatter->asDate($model->updated_at);
                }
            ],
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
                    return "/question/$action?id=" . $model->id;
                },
            ],
        ],
    ]); ?>

</div>
