<?php

use yii\grid\GridView;

/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        ['label' => 'Quiz Name',
            'value' => function ($model) {
                return $model->quiz_name;
            }
        ],
        'min_correct',
        ['label' => 'Number of correct answers',
            'value' => 'correct_answer_count'
        ],
        ['label' => 'Percent',
            'value' => function ($model) {
                return round(($model->correct_answer_count * 100) / ($model->number_of_questions)) . '%';
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
        ['label' => 'Passed By',
            'value' => function ($model) {
                return $model->createdBy['username'];
            }

        ],
        ['label' => 'Validation',
            'value' => function ($model) {
                if ($model->certificate_valid_time === null) {
                    return '';
                }
                if (date('Y-m-d H:i:s') > $model->certificate_valid_time) {
                    return 'Invalid';
                }

                if (date('Y-m-d H:i:s') <= $model->certificate_valid_time) {
                    return 'Valid';
                }


            },

            'contentOptions' => function ($model) {
                return ['style' => 'color:' . (date('Y-m-d H:i:s') > $model->certificate_valid_time ? 'red' : 'green')];
            }
        ],
        ['label' => 'Valid Until',
            'value' => function ($model) {
                  if($model->certificate_valid_time ==null) {
                      return '';
                  }
                  else{
                      return $model->certificate_valid_time;
                  }
            }

        ],


    ],


]); ?>

