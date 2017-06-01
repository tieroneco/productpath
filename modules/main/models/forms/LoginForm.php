<?php
namespace app\modules\main\models\forms;

use yii;
use yii\base\Model;

use app\models\User;

class LoginForm extends Model{
    public $email,$password;
    
    public function rules(){
        return [
            ['email','email','message'=>'This is not a valid email.'],
            ['email','required','message'=>'Email required.'],
            ['password', 'required', 'message'=>'Password required.']
        ];
    }
    
    public function notExists($attribute,$params, $validator){
        
        if(User::findOne(['email'=>$attribute])){
            $this->addError('email','User already exists');
        }
    }
    public function attributeLabels() {
        return [            
            'email'=>'EMAIL',
            'password'=>'PASSWORD',
            
        ];
    }
}
?>