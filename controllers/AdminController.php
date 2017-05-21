<?php
namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Idea;
use app\models\Reply;
use app\models\Site;
use app\models\SiteBrand;
use app\models\forms\LogoUpload;
use yii\web\UploadedFile;


class AdminController extends Controller{
    public $layout = 'backend';
    function behaviors() {
         return [
             'hostControl' => [
                'class' => \yii\filters\HostControl::className(),
                'except' => ['error'],
                'allowedHosts' => function($action) {
                    $host = \yii::$app->request->hostName;
                    $site = Site::find()
                            ->where(['like', 'subDomain', $host])
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
                'except' => ['all-action-required'],
                'rules' => [
                    [
                        'allow' => true,
                        //'actions' => ['index', 'change-state', 'reply', 'save-brand', 'get-brand'],
                        'roles' => ['admin'],
                    ],                    
                ],
            ],
        ];
        
    }
    
    function actionLogout(){
        \yii::$app->user->logout();
        return $this->redirect('/');
    }
    public function beforeAction($action) {
        if (in_array($action->id, ['up', 'down', 'comment'])) {

            $this->enableCsrfValidation = false;
        }
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    function actionIndex(){      
        return $this->render('adminhome');
    }
    function actionChangeState(){
        $post = \yii::$app->request->post('Idea');
        $idea = Idea::findOne($post['id']);
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $idea->status = $post['status'];
        if($idea && $idea->validate()){
            $idea->save(false);
            return $idea->id;
        }else{
            return $idea->getErrors();
        }        
    }
    
    function actionReply(){
        $model = new Reply;
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($model->load(\yii::$app->request->post()) && $model->validate()){
            $model->save(false);
            return $model->id;
        }
        return 0;
    }
    
    function actionSaveBrand(){   
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new LogoUpload();
        $image_filename = '';
        if(isset($_FILES['logoFile'])){            
            $_FILES['LogoUpload[logoFile]']= $_FILES['logoFile'];
            unset($_FILES['logoFile']);
            $model->logoFile = UploadedFile::getInstance($model, 'logoFile');
            if($model->validate()){
                if($model->upload()){
                    $image_filename = $model->logoFile->baseName . '.' . $model->logoFile->extension;
                }
            }else{
                $errors = $model->getErrors(); ;
            }
        }
        $site_brand=[
            'SiteBrand'=> \yii::$app->request->post()
        ];
       if(!isset($site_brand['SiteBrand']['id'])){
           $siteBrandModel = new SiteBrand();
       }else{
           $siteBrandModel = SiteBrand::findOne($site_brand['SiteBrand']['id']);
       }
       if($siteBrandModel && $siteBrandModel->load($site_brand) && $siteBrandModel->validate(1)){
           $siteBrandModel->siteId = \yii::$app->params['site']->id;
           if($image_filename){
               if($siteBrandModel->logoFile){
                   echo $old_file = \yii::getAlias('@webroot').'/logo/'.$siteBrandModel->logoFile;
                   if(file_exists($old_file)){
                       unlink($old_file);
                   }
                   
               }
               $siteBrandModel->logoFile = $image_filename;
           }
           $siteBrandModel->save(false);
           return $siteBrandModel->getAttributes();
                   
       }elseif($siteBrandModel){
           return $siteBrandModel->getErrors();
       }else{
           return 0;
       }
    }
    
    function actionGetBrand(){
        \yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $brand = SiteBrand::find()
                ->where(['siteId'=> \yii::$app->params['site']->id])
                ->asArray()
                ->one();
        return $brand;
        
        
    }
}


