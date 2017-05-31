<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>FeatureTrack</title>
    <?php $this->head() ?>
  </head>
  <body>
      <?php $this->beginBody() ?>
     <div id="wrap">
     <div id="main"> 
  	<div class="bg-image"></div>
    <div class="header clearfix home-header">
    	<div class="logo"><a href="#"><img src="/images/logo-white.png"></a></div>
        <div class="header-loginbox clearfix">
            <span class="sign-up-link btn custom-btn" onclick="javascript:window.location.href='/site/register'">Sign Up</span><span class="login-link btn" onclick="javascript:window.location.href='/site/login'">Login</span><span class="free-text">Free while in beta</span> 
        </div>
	</div>
    
    <?= $content?>
    <div class="copyright">
    	<div class="container">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                Powered by <a href="#">FeatureTrack.</a> &copy;2017 All Rights Reserved.
            </div>
        </div>
    </div>

    </div>
    
    <?php $this->endBody() ?>
    <script type="text/javascript">
      jQuery(window).load(function(){
  
        jQuery(".top-create-site").ghostInput({
           ghostText:".featuretrack.co",
               ghostPlaceholder:".yourproduct.featuretrack.co",
               ghostTextClass: "ghost-text"
        });
  
        jQuery(".bottom-create-site").ghostInput({
           ghostText:".featuretrack.co",
               ghostPlaceholder:".yourproduct.featuretrack.co",
               ghostTextClass: "ghost-text"
        });
  
      });

    </script>
  </body>
</html>
<?php $this->endPage() ?>