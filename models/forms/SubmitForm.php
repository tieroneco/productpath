<?php

namespace app\models\forms;

use yii;
use yii\base\Model;

class SubmitForm extends Model{
    public $title,$description,$email,$name,$receiveUpdate;
    
    public function rules(){
        return [
            [['title','description','email', 'name'], 'required'],
            ['email','email'],
            ['receiveUpdate','boolean']
            
        ];
    }
    
    public function attributeLabels() {
        return [
            'title'=>'Idea Title',
            'description'=>'Idea Description',
            'email'=>'Your Email',
            'name'=>'Your Name'
        ];
    }
}

