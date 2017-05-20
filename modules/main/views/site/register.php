<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="container">
        	<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="login-logo">
                    	<a href="#"><img src="/images/logo-white.png" alt=""></a>
                    </div>
                    
                    <div class="login creat_acc-popup">
                    	<div class="login-head">
                                <?php
                                    if(yii::$app->session->hasFlash('registrationdone')){
                                        ?><h2><?= yii::$app->session->getFlash('registrationdone');?></h2>
                                <?php    }else{
                                ?>
                        	<h2>Create Account</h2>
                                    <?php }?>
                        </div>
                        
                        <div class="login-footer">
                        	<ul>
                            	<li class="login-g-plus">
                                	<a href="#"><em><img src="/images/logo-google.png" alt=""></em> <span>Sign in with Google</span></a>
                                </li>
                                <li class="login-facebook">
                                	<a href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                </li>
                                <li class="login-twitter">
                                	<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                            </ul>	
                        </div>
                        
                        
                        <div class="popup-body clearfix">
                            <?php $form=ActiveForm::begin([
                                    'id'=>'register-form',
                                    'options'=>['method'=>'post'],
                                    'fieldConfig'=>['template'=>
                                            "<div class=\"col-lg-6 col-md-6 col-sm-12 col-xs-12\">"
                                        . "<label>{label}</label>\n{input}\n{error}</div>"
                                    ]
                                ])?>
                        	
                                <div class="row">
                                    <?= $form->field($model,'host')->textInput(['placeHolder'=>'Your Site'])?>
                                    <?= $form->field($model,'email')->textInput(['placeHolder'=>'Your Email address'])?>
                                    <?= $form->field($model,'password')->passwordInput(['placeHolder'=>'******'])?>
                                    <?= $form->field($model,'confirmPassword')->passwordInput(['placeHolder'=>'******'])?>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?= Html::submitButton('Create Account', ['class' => 'submit-btn btn-big center-block btn']) ?>                                        
                                    </div>
                                </div>
                            <?php ActiveForm::end()?>
                        </div>
                    </div>
                    
                    <div class="creat_acount_link odd">Already a member? <a href="/site/login">Sign In</a></div>
                </div>
            </div>
        </div>
<style id="rectify-design">
    .form-group{
        margin-bottom: 0;
    }
    .help-block{
        min-height: 20px;
        display: block;
    }
</style>
<?php
    $domain = yii::$app->params['domainName'];
    $this->registerJs(<<<JS
    $('#registerform-host').blur(function(){
            var v = $(this).val();
            if(v !='' && v.indexOf('http://') == -1){
                $(this).val('http://'+v+'.$domain')
            }
   })
JS
            ,
            \yii\web\View::POS_READY,
            'makeSiteAdress'
            );
?>