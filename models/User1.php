<?php
namespace app\models;
use app\components\MyBehavior;
use yii\base\Model;
class User1 extends Model{
const USER_REGISTERED='USER REGISTERED';
    public function method($event){
        $event->handled=true;
        echo " triggered";
    }

   public function behaviors(){
        return [
          'class'=> MyBehavior::className(),
        ];
   }



}