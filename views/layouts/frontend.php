<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
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
    <title><?= $this->title ? $this->title : 'Feature Tracker'?></title>
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <base href="/">
  </head>
  <body>
      <?php $this->beginBody() ?>
    <div class="header header-inner clearfix">
    	<div class="logo"><a href="<?= Url::to('',true)?>"><img src="images/logo.png"></a></div>
        <div class="tagline">Send in your product ideas!</div>
        <div class="company-mane"><a href="<?= Url::to('https://'.\yii::$app->params['domainName'])?>">FeatureTrack.co</a></div>
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