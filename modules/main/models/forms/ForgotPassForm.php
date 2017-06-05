<?php
namespace app\modules\main\models\forms;

use yii;
use yii\base\Model;

use app\models\User;

class ForgotPassForm extends Model{
    public $email;
    
    public function rules(){
        return [
            ['email','email','message'=>'This is not a valid email.'],
            ['email','required','message'=>'Email required.']
            
        ];
    }
    public function attributeLabels() {
        return [            
            'email'=>'EMAIL',            
            
        ];
    }
}
?>