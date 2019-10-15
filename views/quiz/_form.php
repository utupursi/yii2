<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Quiz */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #p{
        color:red;
        font-size:20px;
    }
</style>
<div class="quiz-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php  if($error){
        echo "<span id='p'>$error</span>";
    } ?>
    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_correct')->textInput() ?>

    <?= $form->field($model, 'max_question')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>