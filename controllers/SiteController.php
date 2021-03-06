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
use app\models\Comment;
use app\models\forms\RegisterForm;
use app\models\forms\SubmitForm;
use app\models\SiteBrand;

class SiteController extends Controller {

    public function behaviors() {
        $behaviors = parent::behaviors();
        $child_behaviors = [
            'hostControl' => [
                'class' => \yii\filters\HostControl::className(),
                'except' => ['error'],
                'allowedHosts' => function($action) {
                    $host = \yii::$app->request->hostName;
                    $site = Site::find()
                            ->where(['like', 'subDomain', $host])
                            ->andWhere(['state' => 1])
                            ->one();
                    if ($site) {

                        \yii::$app->params['site'] = $site;
                        return [$host];
                    } else {
                        return ['nodomainmustnotexist.com'];
                    }
                }
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login'],
                'rules' => [
                        [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?']                        
                        ],                        
                ],
		'denyCallback'=>function(){
			$user = \yii::$app->User->identity;
			if($user){
				$site = $user->sites;
				if($site && isset($site[0])){
					return $this->redirect($site[0]->subDomain.'/admin');
				}else{
					return $this->redirect('//'. \yii::$app->params['domainName'].'/admin');
				}
			}			
		}
            ],
        ];

        return array_merge($behaviors, $child_behaviors);
    }
    
    
    public function beforeAction($action) {


        if (in_array($action->id, ['up', 'down', 'comment'])) {

            $this->enableCsrfValidation = false;
        }
        $return = parent::beforeAction($action);
        $site_brand = SiteBrand::findOne(['siteId' => \yii::$app->params['site']->id]);
        $this->view->params['site_brand'] = $site_brand;
        return $return;
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
                       ->andWhere(['site.id'=>\yii::$app->params['site']->id])                       
                       ->one();
               if($user){
                   \yii::$app->user->login($user);
                   return 1;
                   
               }
           }
       }
       return 0;
    }
    /**
     * @inheritdoc
     */
    public function actions() {
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
    public function actionIndex() {
        $model = new \yii\base\DynamicModel();
        $model->addRule(['name'], 'string', ['max' => 12]);



        return $this->render('index', compact('model', 'site_brand'));
    }

    public function actionGetIdeas($filter) {
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $offset = \yii::$app->request->get('offset');
        $ideas = Idea::getideasByFilter($filter, $offset, 2, \yii::$app->request->get('q'));
        $ideas = array_map(function($a) {
            if (isset($a['createdAt'])) {
                $a['createdAt'] = date('M d Y', $a['createdAt']);
            }
            if (isset($a['body'])) {
                $a['body'] = substr($a['body'], 0, 150) . '...';
            }
            return $a;
        }, $ideas);
        return $ideas;
    }

    public function actionIdea($id) {
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $idea = Idea::getIdea($id, \yii::$app->request->get('next'));
        $idea = $idea ? $idea : [];
        if (!$idea)
            return $idea;
        $idea = array_map(function($a) {
            if (isset($a['createdAt'])) {
                $a['createdAt'] = date('M d Y', $a['createdAt']);
            }
            return $a;
        }, $idea);
        if (isset($idea['createdAt'])) {
            $idea['createdAt'] = date('M d Y', $idea['createdAt']);
        }
        return $idea;
    }

    public function actionSubmit() {
        $ideaModel = new Idea;
        $ideaUserModel = new IdeaUser;
        $owner = \yii::$app->params['site']->user;
        $site = \yii::$app->params['site'];
        
        if (\yii::$app->request->isPost && $ideaModel->load(\yii::$app->request->post()) && $ideaUserModel->load(\yii::$app->request->post()) && $ideaUserModel->validate()
        ) {
            $ideaUser = IdeaUser::findOne(['email' => $ideaUserModel->email]);
            if ($ideaUser) {
                $ideaUserId = $ideaUser->id;
            } else {
                $ideaUserModel->save();
                $ideaUserId = $ideaUserModel->id;
            }
            $ideaModel->ideaUserId = $ideaUserId;
            $ideaModel->createdAt = time();
            if ($ideaModel->validate()) {
                $ideaModel->siteId = \yii::$app->params['site']->id;
                $ideaModel->status = -1;
                $ideaModel->save();
                \yii::$app->session->setFlash('ideaSubmitted');
                
                if($owner->receive_email ==1 && \yii::$app->params['mailSent']){
                    try{
                    Yii::$app->mailer->compose('layouts/ideaposted', compact('ideaUser','ideaModel', 'owner','site'))
                    ->setFrom('from@domain.com')
                    ->setTo($owner->email)
                    ->setSubject("A new site has been submitted at {$site->subDomain} ")
                    ->send();
                    }catch(Exception $e){
                        $mail_sent = false;
                    }
                }
                return $this->redirect("/");
            }
        }
        return $this->render('submit', compact('ideaModel', 'ideaUserModel'));
    }

    public function actionUp() {
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $_POST = json_decode(file_get_contents("php://input"), true);
        $idea = Idea::findOne($_POST['id']);
        if ($idea) {
            $idea->updateCounters(['votes' => 1]);
            $command = \yii::$app->db->createCommand()
                    ->insert('idea_ip',[
                        'idea_id'=>$idea->id,
                        'ip'=>\yii::$app->request->getUserIP()
                    ])
                    ->execute();
            
            return true;
        }
        return false;
    }

    public function actionDown() {
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $_POST = json_decode(file_get_contents("php://input"), true);
        $idea = Idea::findOne($_POST['id']);
        if ($idea) {
            $idea->updateCounters(['votes' => -1]);
            $command = \yii::$app->db->createCommand("delete from idea_ip where idea_id = {$idea->id} and ip =:ip");
            $command->bindValue(':ip',\yii::$app->request->getUserIP())->execute();
            return true;
        }
        return false;
    }

    public function actionComment() {
        $POST = \yii::$app->request->post();
        $ideaUserModel = IdeaUser::findOne(['email' => \yii::$app->request->post('email')]);
        if (!$ideaUserModel) {
            $ideaUserModel = new IdeaUser;
            $ideaUserModel->email = $POST['email'];
            $ideaUserModel->name = $POST['name'];
        }
        if ($ideaUserModel->save()) {
            $commentModel = new Comment();
            $commentModel->ideaId = $POST['ideaId'];
            $commentModel->commentUserId = $ideaUserModel->id;
            $commentModel->createdAt = time();
            $commentModel->commentText = $POST['comment'];
            if ($commentModel->save()) {
                \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                $u = $commentModel->commentUser;
                return $commentModel;
            }
        }
        echo 0;
    }

    function actionSearch() {
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $ideas = Idea::getSimilar(\yii::$app->request->get('q'), \yii::$app->params['site']->id);

        return $ideas;
    }

    public function actionLogin() {
        $this->layout = 'login';
        $model = new \app\modules\main\models\forms\LoginForm();
        if ($model->Load(\yii::$app->request->post()) && $model->validate()) {
            $user = User::find()
                    ->where(['email' => $model->email])
                    ->one();
            if ($user) {
                if (\yii::$app->security->validatePassword($model->password, $user->password)) {
                    $role = \Yii::$app->authManager->getRolesByUser($user->id);
                    if (isset($role['superAdmin'])) {
                        \yii::$app->user->login($user);
                        return $this->redirect('/admin');
                    } elseif (isset($role['admin'])) {
                        $site = $user->sites[0];
                        \yii::$app->user->login($user);
                        return $this->redirect(\yii\helpers\Url::to($site->subDomain . '/admin', false));
                    } else {
                        $model->addError('email', 'User is ont privilaged');
                    }
                } else {
                    $model->addError('password', 'Wrong password. Try again.');
                }
            } else {
                $model->addError('email', 'Not a valid user');
            }
        }
        return $this->render('login', compact('model'));
    }

}
