<?php
use yii\helpers\Html;
?>
<style>
    #o{
        margin-top:100px;
    }
</style>
<div class="jumbotron text-center">

<?php if(Yii::$app->user->isGuest):?>
    <div class="display-3" style="font-size: 25px;color:red">You are not log in</div>
    <div style="font-size: 25px;">If you want to pass quiz please <?= Html::a('Log in', ['site/login'], ['class' => 'btn btn-success']) ?></div>
<?php endif;?>
    <?php if(!Yii::$app->user->isGuest):?>
        <div id="o"><?= Html::a('Create Quiz', ['quiz/create'], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Start Quiz', ['site/start'], ['class' => 'btn btn-success']) ?>

        </div>
    <?php endif;?>
</div>
