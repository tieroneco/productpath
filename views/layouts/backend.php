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
    <base href="/">
  </head>
  <body>
      <?php $this->beginBody() ?>
    <div class="header header-inner clearfix">
    	<div class="logo"><a href="#"><img src="/designassets/images/logo.png"></a></div>
        <div class="admin-header-loginbox clearfix">
       		<span class="sign-up-link btn admin-btn submit-btn">Visit Site</span><span class="login-link btn">Logout</span><div class="free-text">Email Support </div>
        </div>
	</div>
 
  <?= $content?>
   
    
    
    
    <?php $this->endBody() ?>
    
  </body>
</html>
<?php $this->endPage() ?>