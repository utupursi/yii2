<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Quiz */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #p {
        color: red;
        font-size: 20px;
    }
</style>
<div class="quiz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_correct', ['enableAjaxValidation' => true])->textInput() ?>

    <?= $form->field($model, 'max_question',['enableAjaxValidation' => true])->textInput() ?>

    <?= $form->field($model, 'certificate_valid_time')->dropDownList(['prompt' => 'Select', 'months' => $items]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
