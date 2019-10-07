<?php
namespace app\components;

use yii\base\Behavior;
class MyBehavior extends Behavior{
    public $property1="erti";
    public $property2="ori";

    public function foo(){
        echo "metod";
    }
}