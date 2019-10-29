<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

/* @var $quiz app\models\Quiz */


$this->title = 'Create Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['quiz/view','id'=>$quizId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= $this->render('_form', [
        'model' => $model,
        'error' =>$error,
        'quizId'=>$quizId,
    ]) ?>

</div>
