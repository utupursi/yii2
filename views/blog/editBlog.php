<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>


<style>
  #p {
    margin-top: 10px;
  }

  #k {
    font-size: 20px;
  }

  body {
    /* background-image: url("https://i.ytimg.com/vi/jkEL-9TlN8Y/maxresdefault.jpg"); */
    background-size: 100%;
  }

  #field1 {
    width: 300px;
    /* border:1px solid whitesmoke; */
  }
</style>
<!DOCTYPE html>
<head>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
</head>
<body>

<div class="content">
  <div class="container">
    <h2 class="text-center"></h2>
      <?php $form = ActiveForm::begin(); ?>
    <div class="form-group" id="p">
        <?= $form->field($model, 'header')->textInput(['value' => $model->header]) ?>
    </div>

    <div class="container py-2">
      <div class="row">
        <div class="col-4">

        </div>
      </div>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'category')->dropDownList(['International' => 'International', 'Tours and Travels' => 'Tours and Travels',
            'Cooking Tips' => 'Cooking Tips'], ['value' => $model->category]) ?>
    </div>

    <div class="form-group">
        <?= $form->field($model, 'image')->fileInput(['maxFileSize' => 5120 * 10]) ?>
    </div>
    <div class="form-group">
        <?= $form->field($model, 'text')->textarea(['id' => 'summernote', 'value' => $model->text]) ?>
    </div>
    <div class="form-group">
      <label for="field1">Video Link</label>
        <?= $form->field($model, 'link')->textInput(['placeholder' => 'https://www.youtube.com/watch?v=ITKBiGhwwLo', 'value' => $model->link]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
      <?php ActiveForm::end(); ?>
  </div>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js" defer></script>
<script>
  $(document).ready(function () {
    $('#summernote').summernote();
  });
</script>

</body>

</html>