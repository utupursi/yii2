<?php

use yii\helpers\Html;

use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\QuizSearch */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\controllers\QuizController */
/* @var $pagination yii\data\Pagination */
/* @var $quiz yii\gii\controllers\ */
/* @var $questions app\controllers\QuizController */
?>

<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>-->
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<!--<Include the above in your HEAD tag >-->
<?php $final1 = json_encode($questions);
file_put_contents('js/json.json', $final1);
?>

<input value="<?php echo $questions[0]['quiz_id'] ?>" id="2" hidden ?>
<div class="container-fluid">
    <div class="modal-dialog">
        <ul>
            <?php if (isset($errorOfChoose)): ?>
                <p style="color:red;font-size:20px"><?php echo $errorOfChoose ?></p>
            <?php endif; ?>
            <?php if (isset($errorOfInsert)): ?>
                <p style="color:red;font-size:20px"><?php echo $errorOfInsert ?></p>
            <?php endif; ?>


            <?php $form = ActiveForm::begin(); ?>


            <div class="modal-content">
                <div class="modal-header">

                    <h3>
                        <i><?php echo $quiz->subject ?></i>
                    </h3>

                </div>
                <div class="modal-body">


                    <div class="quiz" id="quiz">

                        <h3>
                            <div id="question"></div>

                        </h3>
                        <hr>

                    </div>


                </div>
                <div class="modal-footer text-muted">
                    <span id="answer"></span>

                </div>


                <div style="padding: 0 15px 15px 0" class="pull-right">
                    <button id="PreviousButton" type="button" class="btn btn-success">Previous</button>
                    <button id="nextButton" type="button" class="btn btn-success">Next</button>
                    <!--                        --><?php //= Html::submitButton('Submit!', ['class' => 'btn btn-primary','id'=>nextButton''],) ?>

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
<?php $this->registerJsFile('@web/js/test.js', ['depends' => [yii\web\JqueryAsset::className()]]); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--<script type="text/javascript" src="@web/js/json.json"></script>-->
<!--<script type="text/javascript" src="webroot/json.json">-->
<!--    let currentQuestion = 0;-->
<!--    let score = 0;-->
<!--    let container = document.getElementsByClassName('modal-body');-->
<!--    let questionEl = document.getElementById('question');-->
<!--    let option = document.getElementsByName('selectedAnswer');-->
<!--    let data = JSON.parse(data);-->
<!--    console.log(data);-->
<!---->
<!--    console.log('f');-->
<!---->
<!--</script>-->

<link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">
