<?php
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
      var csrfToken = $('meta[name="csrf-token"]').attr("content");
       
       jQuery.ajax({
           url:'/site/fb-login',
           data:{
               email:basicProfile.getEmail(),
               '_csrf':csrfToken,
               'id':basicProfile.getId(),
               'type':'AuthGP'
           },
           type:'post',
           dataType:'json',
           success:function(r){
               if(r){
                window.location.href=r;
                }else if(r == 0){
                    $('.login-head h2').text('Can\'t Authenticate' );
                }
            
           },
           error:function(r){
               $('.login-head h2').text('Can\'t Authenticate' );
           },
           complete:function(){
               console.log('complete');
           }
       })
      console.log('Logged in as: ' + googleUser.getBasicProfile().getEmail());
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
    //<?php
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/oauth/request_token');
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
//        curl_setopt($ch, CURLOPT_HEADER, array(
//            'OAuth oauth_nonce="K7ny27JTpKVsTgdyLdDfmQQWVLERj2zAK5BslRsqyw"',
//            'OAuth oauth_callback="'. urlencode('https://'.\yii::$app->params['domainName'].'/site/login').'"',
//            'oauth_consumer_key=cART2ssNGs16noAp5HVu995ZR',
//            'oauth_signature="F1Li3tvehgcraF8DMJ7OyxO4w9Y%3D"',
//            'oauth_signature_method="HMAC-SHA1"',
//            'oauth_timestamp="'.time(),
//            'oauth_version="1.0"'
//        ));
//        $result = curl_exec($ch);
//        
//        var_dump(curl_error($ch));exit;
//        
//    ?>
</script>
<style>
    .abcRioButtonContentWrapper span{font-size: 11px !important;}
</style>
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
                                        <div id="g-signin2" style="font-size:12px"></div>
<!--                                        <a href="#"><em><img src="/designassets/images/logo-google.png" alt=""></em> <span>Sign in with Google</span></a>-->
                                    </li>
                                    <li class="login-facebook">
                                        <a href="javascript:void(0)" onclick="FeatureTrackFBLogin()"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="login-twitter">
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                </ul>	
                            </div>

                            <div class="close-icon"><a href="/"><img src="/designassets/images/cross.png" alt=""></a></div>
                        </div>
