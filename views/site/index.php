<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\QuizSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>



<style>
    #e{
        width:80px;
    }
</style>

<h1>Quizes</h1>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Subject</th>

    </tr>
  </thead>

  <tbody>
  <?php
  for($i=1;$i<=count($quiz);$i++):?>

  <tr>
      <th scope="row"><?php echo $i?></th>
      <td><?php echo $quiz[$i-1]['subject']?></td>
<td>
    <?= Html::a('Start', ['quiz/quiz','id'=>$quiz[$i-1]['id'],'i'=>-1], ['class' => 'btn btn-success']) ?>

</td>
    </tr>
  <?php endfor;?>
  </tbody>
</table>

