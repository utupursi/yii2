<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Create Answer';

$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['question/view','id'=>$questionId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $model->id;?>
<div class="question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'error' => $error,
        'quizId' => $questionId,
    ]) ?>

</div>
