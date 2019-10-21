<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        ['label' => 'Quiz Name',
            'value' => function ($model) {
                if ($model->quiz_id != '') {
                    return $model->quiz->subject;
                } else {
                    return $model->quiz_name;
                }

            }
        ],
        'min_correct',
        ['label' => 'Number of correct answers',
            'value' => 'correct_answer_count'
        ],
        ['label' => 'Percent',
            'value' => function ($model) {
                return round(($model->correct_answer_count * 100) / ($model->number_of_questions)). '%';
            }
        ],

        ['label' => 'pass',
            'value' => function ($model) {
                if ($model->correct_answer_count < $model->min_correct) {

                    return 'Failed';
                } else {
                    ['contentOptions' => ['style' => 'color:red']];
                    return 'Passed';
                }
            },
            'contentOptions' => function ($model) {
                return ['style' => 'color:' . ($model->correct_answer_count < $model->min_correct ? 'red' : 'green')];
            }


        ],
        [
            'label' => 'Date of pass quiz',
            'value' => function ($model) {
                return Yii::$app->formatter->asDatetime($model->quiz_pass_date);
            }
        ],
        ['label' => 'Created By',
            'value' => function ($model) {
                return $model->createdBy->username;
            }

        ],
        ['label' => 'Updated_By',
            'value' => function ($model) {
                return $model->createdBy->username;
            }

        ],

    ],


]); ?>

