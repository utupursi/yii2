<table class="table">
    <thead class="thead-dark">
    <tr>

        <th scope="col">#</th>
        <th scope="col">Quiz_id</th>
        <th scope="col">Min_Correct</th>
        <th scope="col">Number of correct answers</th>
        <th scope="col">Quiz pass date</th>
    </tr>
    </thead>
    <?php $i = 1;
    foreach ($results as $result):?>
        <tbody>

        <tr>
            <th scope="row"><?php echo $i;$i++?></th>
            <td><?php echo $result->quiz_id ?></td>
            <td><?php echo $result->min_correct ?></td>
            <td><?php echo $result->correct_answer_count ?></td>
            <td><?php echo  Yii::$app->formatter->asDatetime($result->quiz_pass_date) ?></td>
        </tr>
        </tbody>

    <?php endforeach; ?>
</table>

