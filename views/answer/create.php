<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'error' =>$error,
    ]) ?>

</div>
