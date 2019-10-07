<style>
    #a{
        height:100px;
    }
</style>
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;?>

<?php $form = ActiveForm::begin([
    'id' => 'signup-form',
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
    'options'=>['enctype'=>'multipart/form-data']
]); ?>
       <?= $form->field($model, 'blog_header')->textInput(['autofocus' => true]) ?>
      <?=  $form->field($model, 'blog_body')->textarea(['rows'=>'6']) ?>
       <?=$form->field($model, 'category')->dropDownList(['international'=>'international','cooking_tips'=>'cooking tips'],['prompt'=>'select category']) ?>
      <?=$form->field($model, 'file')->fileInput() ?>




    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Post', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>