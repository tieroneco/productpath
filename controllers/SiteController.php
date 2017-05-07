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
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','register'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions'=>['register'],
                        'allow'=>true,
                        'roles'=>['?']
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
    
    /**
     * Action register
     */
    public function actionRegister(){
        $this->layout = 'register';
        $model = new RegisterForm;
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            \yii::$app->db->transaction(function() use($model){
                $user = new User;
                $user->email = $model->email;
                $user->active = 0;
                $user->activattionKey = Yii::$app->getSecurity()->generateRandomString();
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                if($user->save()){
                    
                    $site = new Site;
                    $site->subDomain = $model->host;
                    $site->user_id = $user->id;
                    $site->state = 0;
                    $site->createdAt = date('Y-m-d H:i:s');
                    if(!$site->save(false)){
                        throw new \yii\base\UserException();
                    }
                    Yii::$app->mailer->compose('layouts/test', ['contactForm' => $model])
                    ->setFrom('from@domain.com')
                    ->setTo($model->email)
                    ->setSubject("test")
                    ->send();
                }else{
                    throw new \yii\base\UserException();
                }
                $auth= \yii::$app->getAuthManager();
                $auth->assign($auth->getRole('admin'), $user->id);
            }) ;
           
        }
        return $this->render("register", compact('model'));
    }
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message='Hello'){
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry(){
        $model = new EntryForm();
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            return $this->render('entry-confirm', ['model' => $model]);
        }else{
            return $this->render('entry', ['model' => $model]);
        }
    }
}
