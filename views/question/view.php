<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Quiz */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quizzes', 'url' => ['quiz/index']];
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
            'quiz_id',
            'name',
            'max_ans',
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
            'created_at:datetime',
            'updated_at:datetime',
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
