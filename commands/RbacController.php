<?php
namespace app\commands;

use yii\console\Controller;
use yii;

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
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

