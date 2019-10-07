
<?php foreach ($countries as $country): ?>
    <li>
        <?php echo $country->name ?>
        <?php echo $country->surname ?>
    </li>
<?php endforeach;?>
<?php

$session=Yii::$app->session;
$cookies = Yii::$app->request->cookies;
$language=$cookies->getValue('language','en');
var_dump($language);

?>

