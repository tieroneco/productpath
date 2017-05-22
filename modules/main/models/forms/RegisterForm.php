<?php
namespace app\modules\main\models\forms;

use yii;
use yii\base\Model;

use app\models\User;

class RegisterForm extends Model{
    public $host,$email,$password,$confirmPassword;
    
    public function rules(){
        return [
            [
                ['host','email','password'], 'required'
            ],
            ['email','email'],
            ['confirmPassword','compare','compareAttribute'=>'password', 'whenClient'=>"function(attr,value){
                return $('#registerform-password').val()!=='';
            }",'when'=>function($model){
                return $model->password !='';
            }],
            [['password'],'string','length'=>[4,30]],
            ['email', 'notExists'],
            ['host','match', 'pattern'=>'~^http://[a-z0-9A-Z\-]+\.'. yii::$app->params['domainName'].'$~']
        ];
    }
    
    public function notExists($attribute,$params, $validator){
        
        if(User::findOne(['email'=>$attribute])){
            $this->addError('email','User already exists');
        }
    }
    public function attributeLabels() {
        return [
            'host'=>'SITE ADDRESS',
            'email'=>'EMAIL',
            'password'=>'PASSWORD',
            'confirmPassword'=>'CONFIRM PASSWORD'
        ];
    }
}
?>