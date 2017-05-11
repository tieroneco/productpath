<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\models\forms\RegisterForm;
use app\models\User;
use app\models\Site;

//++ TODO DELETE
use app\models\ContactForm;
use app\models\EntryForm;

class SiteController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
       
       return $this->render('index');
    }
    
    public function actionGetIdeas($filter){
        \yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        return [
            [
              "id"  =>1,
              "heading" => "test",
              "body"=>"body"  
            ],
            [
              "id"  =>1,
              "heading" => "test",
              "body"=>"body"  
            ]
        ];
    }
    
    
}
