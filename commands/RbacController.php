<?php
namespace app\commands;

use yii\console\Controller;
use yii;
use app\models\User;

class RbacController extends Controller{
    
    public function actionInit(){
        $auth = Yii::$app->authManager;
        $isMyAdmin = new \app\rbac\AdminRule;
        $auth->add($isMyAdmin);
        
        $isAdmin = $auth->createPermission('isAdmin');
        $isAdmin->description ='Admin of a site';
        $isAdmin->ruleName = $isMyAdmin->name;
        $auth->add($isAdmin);
        
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin,$isAdmin);
        
        $isSuperAdmin = $auth->createPermission('isSuperAdmin');
        $auth->add($isSuperAdmin);
        
        $superAdmin = $auth->createRole('superAdmin');
        $auth->add($superAdmin);
        $auth->addChild($superAdmin,$isAdmin);
        
    }
    
    public function actionSuperUserCreate(){
        $user = new User;
        $user->name = 'super Admin';
        $user->email = 'superadmin@tierone.com';
        $user->password = \yii::$app->security->generatePasswordHash('1234');
        $user->createAt = time();
        $user->active=1;
        $user->save();
        $auth= \yii::$app->getAuthManager();
                $auth->assign($auth->getRole('superAdmin'), $user->id);
                echo "super user created";
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

