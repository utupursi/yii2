<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Question;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #p {
        color: red;
        font-size: 20px;
    }
</style>

<span class="answer-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php if ($error) {
        echo "<span id='p'>$error</span>";
    } ?>
    <?= $form->field($model, 'question_id')->dropDownList(
        ArrayHelper::map(Question::find()->all(), 'id', 'name')
    ) ?>



    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_correct')->checkbox() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</span>
</div>
