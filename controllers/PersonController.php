<?php

namespace app\controllers;

use Yii;
use app\models\Person2;
use yii\web\Controller;

class PersonController extends Controller
{
    public function actionPerson($id)
    {

        $query = Person2::find();

        $countries = $query->orderBy('name')
            ->all();

        return  $this->render('test',[
            'countries'=>$countries,
        ]);

    }
}
