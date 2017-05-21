<?php

namespace app\modules\main\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Session;

use app\modules\main\models\forms\RegisterForm;
use app\models\User;
use app\models\Site;

//++ TODO DELETE
use app\models\ContactForm;
use app\models\EntryForm;

class AdminController extends Controller{
    public $layout = 'backend';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['index','logout'],
                        'allow' => true,
                        'roles' => ['superAdmin'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
    function actionIndex(){
        return $this->render('home');
    }
    
    function actionAccounts(){
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $offset = \yii::$app->request->get('offset');
        $sites = Site::find()
                ->with('user')
                ->asArray()
                ->offset($offset)
                ->limit(2)
                ->all();
        if($sites){
            foreach($sites as $k=>&$site){
                if(isset($site['user']['password'])){
                    unset($sites[$k]['user']['password']);
                }
//                $user =&$site['user'];
//                foreach ($user as $e=>&$p){
//                    if($e == 'pasword'){
//                        
//                    }
//                }
            }
        }
        return $sites ? $sites : 0;
    }
}
