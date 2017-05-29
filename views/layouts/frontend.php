<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$appasset = AppAsset::register($this);
$appasset->css[] = 'css/responsive.css';
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
      <?php
        if(yii::$app->session->hasFlash('ideaSubmitted')){
      ?>
      <div class="popup-header">
  	<div class="popup-out"><a href="javascript:void(0)"><img src="images/cress1.png"></a></div>
  	<div class="popup-header-right" style="display:none"><a href="#"><i class="fa fa-facebook-square"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"> <i class="fa fa-google"></i></a>
    </div>
  	<div class="popup-header-left"><strong>BOOM!</strong> Thanks, Your idea has been posted and an admin has been notified to moderate.</div>
  </div>
        <?php }?>
    <div class="header header-inner clearfix"> 
        <?php        
            $site_brand = $this->params['site_brand'];            
            if($site_brand){
                ?>
        <style>
                <?php
                if(isset($site_brand['navButtonColor'])){
                    ?>
                    
                    .shorting-box .btn.custom-btn.active-btn{
                        background:<?=$site_brand['navButtonColor']?> !important;
                    }
                    .vote-count .vote{
                        color:<?=$site_brand['navButtonColor']?> !important;
                        
                    }
                    .vote-box .like:hover{
                        background-color:<?=$site_brand['navButtonColor']?> !important;
                    }
                    <?php
                }
                ?>
                <?php
                if(isset($site_brand['headerTextColor'])){
                    ?>
                    
                    .header-inner .tagline,.company-mane a{
                        color:<?=$site_brand['headerTextColor']?>
                    }
                    <?php
                }
                ?>
                    <?php
                if(isset($site_brand['headerColor'])){
                    ?>
                    
                    .header-inner,.popup-header{
                        background:<?=$site_brand['headerColor']?> none repeat scroll 0 0
                    }
                    <?php
                }
                ?>                   
                    </style>
             <?php
            }
        ?>
    	<div class="logo"><a href="<?= Url::to('',true)?>"><img src="<?= isset($site_brand['logoFile'])? '/logo/'.$site_brand['logoFile'] :
            '/designassets/images/logo.png'?>"></a></div>
        <div class="tagline"><?= isset($site_brand['headerText']) ? $site_brand['headerText'] : 'Send in your product ideas!'?></div>
        <?php
            if(\yii::$app->user->isGuest){
             ?>
             <div class="company-mane"><a href="<?= Url::to('https://'.(isset($site_brand['logoAltText']) ? $site_brand['logoAltText'] : yii::$app->params['domainName']))?>"><?= isset($site_brand['logoAltText']) ? $site_brand['logoAltText']: 'FeatureTrack.co'?></a></div>
                 <?php   
            }else{
              ?>
             <div class="company-mane"><a href="<?= Url::to('/admin')?>"><?= 'Admin'?></a></div>
              <?php  
            }
        ?>
        
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
      <script type="text/javascript">
          
          $(document).ready(function(){
              $(document).on('click','.popup-out a', function(){
                  $('.popup-header').remove();
              })
          })
      </script>
  </body>
</html>
<?php $this->endPage() ?>