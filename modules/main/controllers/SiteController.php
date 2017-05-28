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
use \app\models\IdeaUser;

//++ TODO DELETE


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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
    
    public function actionFbLogin(){
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       if(\yii::$app->request->isPost){
           $p = yii::$app->request->post();
           if($p){
               
               $user = User::find()
                       ->where(['active'=>1])
                       ->andWhere(['email'=>$p['email']])
                       ->joinWith('sites')
                       //->andWhere(['site.id'=>\yii::$app->params['site']->id])                       
                       ->one();
               if($user){
                   $role = \Yii::$app->authManager->getRolesByUser($user->id);
                   if(isset($role['superAdmin'])){
                       \yii::$app->user->login($user);
                       return \yii\helpers\Url::to('/admin');
                   }elseif(isset($role['admin'])){
                       \yii::$app->user->login($user);
                       $site = $user->sites[0];
                       return $site['subDomain'].'/admin';
                   }
                   else{
                       return '/admin';
                   }
                   
               }
           }
       }
       return 0;
    }
    
    /**
     * Displays homepage.
     *
     * @return string
     */  
    public function actionIndex($name='')
    {
       $this->layout = 'home';
       
       $model = new \yii\base\DynamicModel(compact('name'));
       $model->addRule(['name'], 'string', ['max' => 12]);
       $model->addRule(['name'], 'required');
       return $this->render('home', compact('model'));
    }
    
    public function actionActivate(){
        $toekn = \yii::$app->request->get('q');
        if($user = User::findOne(['activationKey'=>$toekn, 'active'=>0])){            
            $user->active = 1;
            $user->activationKey='';
            $user->save();
            $site = $user->sites[0];
            $site->state =1;
            $site->save();
            \yii::$app->user->login($user);            
            return $this->redirect($site->subDomain.'/admin');
            
        }else{
            echo 4;exit;
            $this->render('index');
        }
        
        
    }
    /**
     * Action register
     */
    public function actionRegister(){        
        //$this->layout = 'register';
        $model = new RegisterForm;
        if($sitename=(\yii::$app->request->get('site'))){
            //$sitename = str_replace(['http://',''], $replace, $subject);
            $model->host = $sitename;
        }
        
        if($model->load(Yii::$app->request->post()) && $model->validate()){
            
                $transaction = \yii::$app->db->beginTransaction();
                try{
            //\yii::$app->db->transaction(function() use($model){
                $user = new User;
                $site = new Site;
                $user->email = $model->email;
                $user->active = 0;
                $user->activationKey = Yii::$app->getSecurity()->generateRandomString();
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                
                if($user->save()){                    
                    $site->subDomain = $model->host;
                    $site->user_id = $user->id;
                    $site->state = 0;
                    $site->createdAt = date('Y-m-d H:i:s');                   
                    if(!$site->validate() || !$site->save()){
                        
                        throw new \yii\base\UserException('Site could not be saved');
                    }
                    if(\yii::$app->request->post('social')){
                        //this user used socail login
                        $p = \yii::$app->request->post();
                        $ideaUser = new IdeaUser;
                        $ideaUser->email = $user->email;
                        $ideaUser->authType = @\yii::$app->params['Auth'.$p['social']];
                        $ideaUser->authUserId = $model->password;
                        $ideaUser->createdAt = time();
                        if(isset($p['_firstname'])){
                            $ideaUser->name = $p['_firstname'];
                        }else{
                            $ideaUser->name = 'no name';
                        }
                        if(!$ideaUser->save()){
                            throw new \yii\base\UserException('Social user could not be saved');
                        }
                        
                    }
//                    Yii::$app->mailer->compose('layouts/registration', compact('model','site', 'user'))
//                    ->setFrom('from@domain.com')
//                    ->setTo($model->email)
//                    ->setSubject("Successfull Registration At " . \yii::$app->params['domainName'])
//                    ->send();
                }else{
                    
                    throw new \yii\base\UserException('User could not be saved');
                }
                $auth= \yii::$app->getAuthManager();
                $auth->assign($auth->getRole('admin'), $user->id);
                $transaction->commit();
                $session = \yii::$app->session;
                $session->setFlash("registrationdone", "Your account has been successfully created, Please ".'<a href="'. \yii\helpers\Url::to(['site/activate/?q='.$user->activationKey], true).'">Click Here '
                        . 'to activate your account</a>');
            //}) ;
            }catch(\Exception $e){              
                $transaction->rollBack();                
                $errors = array_merge($user->getErrors(),$site->getErrors());
                $model->addError('email', $e->getMessage());
                foreach($errors as $attr=>$error_details){
                    foreach($error_details as $error){
                        switch($attr){
                            case 'subDomain':
                                $attr = 'host';
                                break;                            
                                
                        }
                        $model->addError($attr,$error);
                        
                    }
                }
               
            }
           
        }
        //+ as there is no redirect so reinitialize the model value
        if(isset($session)) $model = new RegisterForm;
        
        return $this->render("register", compact('model'));
    }
    
    public function actionLogin(){                
        $this->layout='login';
        $model = new \app\modules\main\models\forms\LoginForm();
        if($model->Load(\yii::$app->request->post()) && $model->validate()){
            $user = User::find()
                    ->where(['email'=>$model->email])
                    ->one();
            if($user){
                if(\yii::$app->security->validatePassword($model->password, $user->password)){
                    $role = \Yii::$app->authManager->getRolesByUser($user->id);                    
                    if(isset($role['superAdmin'])){
                        \yii::$app->user->login($user);
                        return $this->redirect('/admin');
                    }elseif(isset($role['admin'])){
                        $site = $user->sites[0];
                        \yii::$app->user->login($user);
                        return $this->redirect(\yii\helpers\Url::to($site->subDomain . '/admin', false));
                    }else{
                        $model->addError('email','User is ont privilaged');
                    }
                }else{
                    $model->addError('email','User not authenitcated');
                }
            }else{
                $model->addError('email','Not a valid user');
            }
                    
        }
        return $this->render('login', compact('model'));
    }
    
}
