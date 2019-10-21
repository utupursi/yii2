<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Quiz;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #p {
        color: red;
        font-size: 20px;
    }
</style>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quiz_id')
        ->dropDownList(
            ArrayHelper::map(Quiz::find()->all(), 'id', 'subject')
        )
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hint')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_ans')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

