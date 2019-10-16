<?php
/* @var $success app\controllers\QuizController */
/* @var $error app\controllers\QuizController */
/* @var $id app\controllers\QuizController */
/* @var $question_count app\controllers\QuizController */
?>

<div class="jumbotron text-center">
    <?php if ($error == ''): ?>
        <h2 class="display-3" style="color:green;"><?php echo $success; ?> </h2>
    <?php endif; ?>

    <?php if ($error != ''): ?>
        <h2 class="display-3" style="color:red;"><?php echo $error; ?> </h2>
    <?php endif; ?>
    <h3><?php echo $count . '/' . $question_count; ?></h3
    <p class="lead">
    <h3>If you want pass quiz again pleas click on Quiz Again</h3></p>
    <hr>

    <p class="lead">
        <a class="btn btn-primary btn-sm" href="quiz?id=<?php echo $id ?>" role="button">Quiz Again</a>
    </p>
</div>

