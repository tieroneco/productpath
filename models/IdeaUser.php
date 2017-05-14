<?php
namespace app\models;

use yii;
use app\models\activerecords\IdeaUser as IdeaUserDb;

class IdeaUser extends IdeaUserDb{
    
    public function rules() {
        $rules = parent::rules();
        return array_merge($rules,[
            ['email', 'email'],
            ['name', 'required'],
            
        ]);
    }
}
