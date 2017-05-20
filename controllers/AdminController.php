<?php
namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use \app\models\Idea;

class AdminController extends Controller{
    public $layout = 'backend';
    function behaviors() {
         return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['all-action-required'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'change-state'],
                        'roles' => ['admin'],
                    ],                    
                ],
            ],
        ];
        
    }
    public function beforeAction($action) {
        if (in_array($action->id, ['up', 'down', 'comment'])) {

            $this->enableCsrfValidation = false;
        }
        
        return parent::beforeAction($action);
    }
    function actionIndex(){
        return $this->render('adminhome');
    }
    function actionChangeState(){
        $idea = new Idea;
        if($idea->load(\yii::$app->request->post())){
            echo 4;
        }
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

