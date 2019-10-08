<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Answer */

$this->title = 'Create Answer';
$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>

</style>
<div class="answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <style>
        #f{
            background-color:papayawhip;
            width:300px;
            border-radius:5px;
            margin-left:2px;
        }
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="container-fluid bg-info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h3><span class="label label-warning" id="qid">2</span><?php echo $model->name;?></h3>
                </div>
                <div class="modal-body">
                    <div class="col-xs-3 col-xs-offset-5">
                        <div id="loadbar" style="display: none;">
                            <div class="blockG" id="rotateG_01"></div>
                            <div class="blockG" id="rotateG_02"></div>
                            <div class="blockG" id="rotateG_03"></div>
                            <div class="blockG" id="rotateG_04"></div>
                            <div class="blockG" id="rotateG_05"></div>
                            <div class="blockG" id="rotateG_06"></div>
                            <div class="blockG" id="rotateG_07"></div>
                            <div class="blockG" id="rotateG_08"></div>
                        </div>
                    </div>

                    <div class="quiz" id="quiz" data-toggle="buttons">
                        <?php $form = ActiveForm::begin(); ?>
<!--                       <?php $number=$model->question_id->max_ans;
                        for($i=0;$i<$number;$i++):?>

                            <label><span class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span> <input  name="q_answer" value="1"></label>
                        <?php endfor;?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer text-muted">
                    <span id="answer"></span>
                </div>
            </div>






        </div>
    </div>


</div>
