
<table class="table">
    <thead class="thead-dark">
    <tr>

        <th scope="col">#</th>
        <th scope="col">Quiz_name</th>
        <th scope="col">Min_Correct</th>
        <th scope="col">Number of correct answers</th>
        <th scope="col">Percentage</th>
        <th scope="col">Pass</th>
        <th scope="col">Quiz pass date</th>
    </tr>
    </thead>
    <?php $g = 1;
    foreach ($results as $result):?>
        <tbody>
        <tr>
            <th scope="row"><?php echo $g;$g++?></th>
          <td><?php echo $result->quiz->subject?></td>
            <td><?php echo $result->min_correct ?></td>
            <td><?php echo $result->correct_answer_count ?></td>
            <td><?php echo ($result->correct_answer_count*100)/($result->number_of_questions)?>%</td>
            <td><?php if($result->correct_answer_count<$result->min_correct):?>
                    <p style="color:red">Failed</p>
                <?php endif;?>
                <?php if($result->correct_answer_count>=$result->min_correct):?>
                    <p style="color:green">Passed</p>
                <?php endif;?>
            </td>
            <td><?php echo  Yii::$app->formatter->asDatetime($result->quiz_pass_date) ?></td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>

