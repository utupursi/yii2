<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuizSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<?php if (isset($errorOfQuiz)): ?>
    <div style="color:red;font-size: 18px"><?php echo $errorOfQuiz; ?></div>
<?php endif ?>
<?php if (isset($errorOfAnswer)): ?>
    <div style="color:red;font-size: 18px"><?php echo $errorOfAnswer; ?></div>
<?php endif ?>
<?php if (isset($errorOfCorrectAnswers)): ?>
    <div style="color:red;font-size: 18px"><?php echo $errorOfCorrectAnswers; ?></div>
<?php endif ?>
<?php if (isset($errorNumberOfQuestion)): ?>
    <div style="color:red;font-size: 18px"><?php echo $errorNumberOfQuestion; ?></div>
<?php endif ?>
<?php if (isset($errorOfStartQuiz)): ?>
    <div style="color:red;font-size: 18px"><?php echo $errorOfStartQuiz; ?></div>
<?php endif ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'headerRowOptions' => ['style' => 'background-color:#00FF7F'],
    'options' => ['style' => 'width:800px'],
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
                'view' => function ($url, $model) use ($arrayOfQuizId) {
                    $count = 0;

                    for ($i = 0; $i < count($arrayOfQuizId); $i++) {
                        if ($model->id == $arrayOfQuizId[$i]) {
                            $count++;
                            return Html::a('<span class="btn btn-success">Resume</span>', $url);
                        }
                    }
                    if ($count < 1) {
                        return Html::a('<span class="btn btn-success">Start</span>', $url);

                    }


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