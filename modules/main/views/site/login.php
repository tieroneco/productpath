<?php
use yii\widgets\ActiveForm;
?>
<script type="text/javascript">
// google oauth client id 580743083689-l0mo4ibsgbn0ov2dsbfn9s9roec15f8h.apps.googleusercontent.com
   function onSignIn(googleUser) {
       alert(4);
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }
  function onFailure(error) {
    alert(error);
}
</script>
<div class="login">
                            <div class="login-head">
                                <h2>SIGN IN</h2>
                            </div>

                            <div class="popup-body clearfix">
                                <?php
                                    $form = ActiveForm::begin([
                                        'id'=>'login-form',
                                        'method'=>'post',
                                        'fieldConfig'=>[
                                            'template'=>"{label}\n{input}\n{error}"
                                        ]
                                    ]);
                                ?>
                                <?= $form->field($model,'email')->textInput()?>
                                <?= $form->field($model,'password')->passwordInput()?>
                                <input type="submit" value="Sign In" class="btn small-btn submit-btn pull-right">
                                <?php $form->end()?>                                
                            </div>

                            <div class="login-footer">
                                <ul>
                                    <li class="login-g-plus">
                                        <div class="g-signin2" data-onsuccess="onSignIn()" data-onfaliure="onfailure"></div>
                                        <a href="#"><em><img src="/designassets/images/logo-google.png" alt=""></em> <span>Sign in with Google</span></a>
                                    </li>
                                    <li class="login-facebook">
                                        <a href="javascript:void(0)" onclick="FeatureTrackFBLogin()"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="login-twitter">
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                </ul>	
                            </div>

                            <div class="close-icon"><a href="#"><img src="/designassets/images/cross.png" alt=""></a></div>
                        </div>
