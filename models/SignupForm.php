<?php


namespace app\models;


use yii\helpers\VarDumper;
use yii\base\Model;

class SignupForm extends Model
{
public $firstName;
public $lastName;
public $username;
public $password;
public $password_repeat;

public function rules()
{
    return [
        [['firstName','lastName','username', 'password', 'password_repeat'], 'required'],
        [['username','password','password_repeat'],'string','min'=>4,'max'=>16],
        ['password_repeat','compare','compareAttribute'=>'password']
    ];
}
public function signup(){
    $user=new User();
    $user->firstName=$this->firstName;
    $user->lastName=$this->lastName;
    $user->username=$this->username;
    $user->password=\Yii::$app->security->generatePasswordHash($this->password);
    $user->access_token=\Yii::$app->security->generateRandomString();
    $user->authKey=\Yii::$app->security->generateRandomString();

    if($user->save()){
        return true;
    }
    \Yii::error('User  was not saved'.VarDumper::dumpAsString($this->errors));
    return false;
}

}