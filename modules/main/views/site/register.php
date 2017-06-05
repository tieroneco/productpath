<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script type="text/javascript">
 // google oauth client id 580743083689-l0mo4ibsgbn0ov2dsbfn9s9roec15f8h.apps.googleusercontent.com
 var gclick = 0;
   function onSuccess(googleUser) {
       ++gclick;
      if(gclick<2)
          return; 
       var basicProfile = googleUser.getBasicProfile();
      $('#register-form #registerform-email').val(basicProfile.getEmail()).attr('readonly',true);
                   $('#register-form #registerform-password').val(basicProfile.getId()).closest('.form-group').hide()
                   $('#register-form #registerform-confirmpassword').val(basicProfile.getId()).closest('.form-group').hide();
                   $('#register-form').append('<input type="hidden" name="social" value="GP">');                   
    }
    function onFailure(error) {
      console.log(error);
    }
    function renderButton() {
      gapi.signin2.render('g-signin2', {
        'scope': 'profile email',
        'width': 165,
        'height': 40,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
      });
    }
</script>
<style>
    .abcRioButtonContentWrapper span{font-size: 11px !important;}
</style>
<div class="container">
        	<div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="login-logo">
                    	<a href="/"><img src="/images/logo-white.png" alt=""></a>
                    </div>
                    
                    <div class="login creat_acc-popup">
                    	<div class="login-head">
                               
                        	<h2>Create Account</h2>
                                
                        </div>
                        
                        <div class="login-footer">
                        	<ul>
                            	<li class="login-g-plus">
                                    <div id="g-signin2" style="font-size:12px"></div>
<!--                                	<a href="#"><em><img src="/images/logo-google.png" alt=""></em> <span>Sign in with Google</span></a>-->
                                </li>
                                <li class="login-facebook">
                                    <a href="javscript:void();" onclick="FBregisterWithProduct()"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
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
