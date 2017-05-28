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
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index','pass-reset', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index','logout', 'pass-reset','delete'],
                        'allow' => true,
                        'roles'=>['superAdmin','?']
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }
    
    function actionIndex(){
        return $this->render('home');
    }
    function actionLogout(){
        \yii::$app->user->logout();
        return $this->redirect('/');
    }
    function actionAccounts(){
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $offset = \yii::$app->request->get('offset');
        $sites = Site::find()
                ->joinWith('user u')
                ->asArray();
        if($s = \yii::$app->request->get('search')){
            $sites->andWhere(['like','subDomain', $s])
                    ->orWhere(['like','u.email', $s]);
        }
         $sites =        $sites->offset($offset)
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
    
    function actionPassReset(){
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($user_id = \yii::$app->request->post('user_id')){
            $user = User::findOne($user_id);
            if($user){
                $password = uniqid();
                $user->password= \yii::$app->security->generatePasswordHash($password);
                $user->activationKey = \yii::$app->security->generateRandomString();
                $user->active = 0;
                // + TO DO need to set the email
                if($user->save()){
                    return 1;
                }else{
                    return 0;
                }
            }
        }
    }
    
    function actionDelete(){
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(($user_id = \yii::$app->request->post('user_id')) && \yii::$app->request->post('del')){
            $user = User::findOne($user_id);
            if($user){
                $site = $user->sites[0];
                $site->state=0;
                
                $user->active = 0;
                if($user->save() && $site->save()){
                    return 1;
                }
            }
        }elseif(($user_id = \yii::$app->request->post('user_id')) && !\yii::$app->request->post('del')){
            $user = User::findOne($user_id);
            if($user){
                $site = $user->sites[0];
                $site->state = 1;
                $user->active = 1;
                if($user->save() && $site->save()){
                    return 1;
                }
            }
        }
        
        return 0;
    }
}
