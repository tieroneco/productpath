<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Session;


use app\models\User;
use app\models\Site;
use app\models\Idea;
use app\models\IdeaUser;

use app\models\forms\RegisterForm;
use app\models\forms\SubmitForm;


class SiteController extends Controller
{
    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $child_behaviors = [
            'hostControl'=>[
                'class' => \yii\filters\HostControl::className(),
                'only'=>['submit','get-ideas','index','idea'],
                'allowedHosts'=>function($action){            
                    $host = \yii::$app->request->hostName;
                    $site = Site::find()
                            ->where(['like','subDomain',$host ])
                            ->one();
                    if($site){
                        
                        \yii::$app->params['site']=$site;
                        return [$host];
                    }else{
                        return ['nodomainmustnotexist.com'];
                    }
                    
                }
            ]
        ];
            
            return array_merge($behaviors,$child_behaviors);
    }
    
    public function beforeAction($action) {
        
        
        if(in_array($action->id, ['up','down'])){
            
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
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
       $model = new \yii\base\DynamicModel();
       $model->addRule(['name'], 'string', ['max' => 12]);
       return $this->render('index',compact('model'));
    }
    
    public function actionGetIdeas($filter){
        \yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $offset = \yii::$app->request->get('offset');
        $ideas = Idea::getideasByFilter($filter,$offset);
        $ideas = array_map(function($a){
            if(isset($a['createdAt'])){
                $a['createdAt'] = date('M d Y',$a['createdAt']);
            }
            if(isset($a['body'])){
                $a['body'] = substr($a['body'], 0,150).'...';
            }
            return $a;
        }, $ideas);
        return $ideas;
    }
    
    public function actionIdea($id){
        \yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $idea = Idea::getIdea($id, \yii::$app->request->get('next'));
        $idea = $idea?$idea:[];
        if(!$idea) return $idea;
        $idea = array_map(function($a){
            if(isset($a['createdAt'])){
                $a['createdAt'] = date('M d Y', $a['createdAt']);
            }
            return $a;
        },$idea);
        if(isset($idea['createdAt'])){
            $idea['createdAt'] = date('M d Y', $idea['createdAt']);
        }
        return $idea;
    }
    public function actionSubmit(){
        $ideaModel = new Idea;
        $ideaUserModel = new IdeaUser;
        if(\yii::$app->request->isPost
                && $ideaModel->load(\yii::$app->request->post())
                && $ideaUserModel->load(\yii::$app->request->post())
                && $ideaUserModel->validate()
        ){
            $ideaUser = IdeaUser::findOne(['email'=>$ideaUserModel->email]);
            if($ideaUser){
                $ideaUserId = $ideaUser->id;
            }else{
                $ideaUserModel->save();
                $ideaUserId = $ideaUserModel->id;
            }
            $ideaModel->ideaUserId = $ideaUserId;
            if($ideaModel->validate()){
                $ideaModel->siteId = \yii::$app->params['site']->id;
                $ideaModel->save();
                return $this->redirect("/");
            }
                        
        }
        return $this->render('submit',compact('ideaModel','ideaUserModel'));
    }
    
    public function actionUp(){
        \yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $_POST = json_decode(file_get_contents("php://input"), true);
        $idea = Idea::findOne($_POST['id']);
        if($idea){
            $idea->updateCounters(['votes'=>1]);
            return true;
        }
        return false;
    }
    public function actionDown(){
        \yii::$app->response->format=\yii\web\Response::FORMAT_JSON;
        $_POST = json_decode(file_get_contents("php://input"), true);
        $idea = Idea::findOne($_POST['id']);
        if($idea){
            $idea->updateCounters(['votes'=>-1]);
            return true;
        }
        return false;
    }
    
}
