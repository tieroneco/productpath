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
        <?= Html::csrfMetaTags() ?>
        <?php $this->head() ?>
        <script src="https://apis.google.com/js/platform.js?onload=renderButton&t=<?= time() ?>" async defer></script>
        <meta name="google-signin-client_id" content="580743083689-l0mo4ibsgbn0ov2dsbfn9s9roec15f8h.apps.googleusercontent.com">
    </head>
    <body>
        <?php $this->beginBody() ?>

        <div class="login-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="login-logo">
                            <a href="/"><img src="/designassets/images/logo-white.png" alt=""></a>
                        </div>
                        <?= $content ?>
                        <?php
                        if (yii::$app->session->getFlash('notice')) {
                            ?>
                        <div  class="creat_acount_link"><a href="/site/login">Already a member? Sign In</a></div>
                        <?php }elseif(isset($this->params['context'])) {
                            echo $this->params['context'];
                        }else{
                                ?><div  class="creat_acount_link"><a href="/site/register">Create Account</a></div>
                                <?php
                            }
                        
                        ?>

                    </div>
                </div>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
