<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAdminAsset;
AppAdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->title ? $this->title : 'Feature Tracker'?></title>
    <?= Html::csrfMetaTags() ?>    
    <?php $this->head() ?>
    <base href="/admin">
  </head>
  <body>     
      <?php $this->beginBody() ?>
      <?php        
            $site_brand = $this->params['site_brand'];            
            
        ?>
     <div id="wrap">
      <div id="inner-main">   
    <div class="header header-inner clearfix">
    	<div class="logo"><a href="javascript:void(0);" id="logo_image"><img src="/designassets/images/logo.png"></a></div>
        <div class="admin-header-loginbox clearfix">
            <a href="/" class="sign-up-link btn admin-btn submit-btn">Visit Site</a>
            <span class="login-link btn" onclick="javascript:window.location.href='admin/logout'">Logout</span><div class="free-text">Email Support </div>
        </div>
	</div> 
  <?= $content?>
   
    
    
    </div><!--Wrap End-->
    </div><!--Inner Main-->
        
    <?php $this->endBody() ?>

  </body>
</html>
<?php $this->endPage() ?>