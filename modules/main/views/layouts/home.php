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
    <title>FeatureTrack</title>
    <?php $this->head() ?>
  </head>
  <body>
      <?php $this->beginBody() ?>
  	<div class="bg-image"><img src="/images/home-bg.png"></div>
    <div class="header clearfix">
    	<div class="logo"><a href="#"><img src="/images/logo-white.png"></a></div>
        <div class="header-loginbox clearfix">
            <span class="sign-up-link btn custom-btn" onclick="javascript:location.href='/site/register'">Sign Up</span><span class="login-link btn" onclick="javascript:location.href='/site/login'">Login</span>free while in beta 
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
    
    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>