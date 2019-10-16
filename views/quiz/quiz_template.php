<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\helpers\ArrayHelper;
use yii\db\ActiveQuery;
USE yii\db\ActiveRecord;

/* @var $this yii\web\View */
/* @var $searchModel app\models\QuizSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\controllers\QuizController */
/* @var $pagination yii\data\Pagination */
?>

<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<!--<Include the above in your HEAD tag >-->

<div class="container-fluid">
    <div class="modal-dialog">
        <ul>

            <?php $form = ActiveForm::begin(); ?>


            <div class="modal-content">
                <div class="modal-header">

                    <h3>
                        <i>QUIZ NAME</i>
                    </h3>

                </div>
                <div class="modal-body">

                    <?php foreach ($questions as $question): ?>

                        <div class="quiz" id="quiz">

                            <h3>
                                <?php echo Html::encode("{$question->name} ") ?>
                            </h3>

                            <?php $answers = \app\models\Answer::find()
                                ->where(['question_id' => $question->id])
                                ->indexBy('id')->all();

                            foreach ($answers as $index => $answer):?>

                                <div class='btn-lg btn-primary btn-block'>
                                    <label>
                                        <?php echo Html::radio("selectedAnswer_{$question->id}", false, [
                                            'value' => $answer->id
                                        ]) ?>
                                        <?php echo $answer->name; ?>
                                    </label>
                                    <!--                                    <label for="-->
                                    <?php //echo "selectedAnswer_{$question->id}"
                                    ?><!--">-->
                                    <!--                                        --><?php //echo $answer->name
                                    ?>
                                    <!--                                    </label>-->

                                </div>

                            <?php endforeach; ?>

                            <hr>

                        </div>

                    <?php endforeach; ?>

                </div>
                <div class="modal-footer text-muted">
                    <span id="answer"></span>

                </div>


                <div style="padding: 0 15px 15px 0" class="pull-right">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                </div>

                <div class="clearfix"></div>
            </div>

            <?php $form = ActiveForm::end(); ?>

        </ul>

    </div>


</div>


</divs


<div style="max-width: 600px; margin: 24px auto;">
</div>


<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
<script>
    let ele = document.getElementsByTagName('input');

    function set() {
        for (i = 0; i < ele.length; i++) {
            if (ele[i].checked) {
                console.log(ele[i]);
            }
        }

    }

</script>
