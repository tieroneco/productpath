<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AppAdminAsset;

AppAsset::register($this);
AppAdminAsset::register($this);
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
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="header header-inner clearfix">
            <div class="logo"><a href="/admin"><img src="images/logo.png"></a></div>
            <div class="admin-header-loginbox clearfix">
                <span class="login-link btn" onclick="javascript:window.location.href='/admin/logout'">Logout</span>  
            </div>
        </div>

        <div class="innerpage-body">
            <div class="admin-left">  
                <div class="dashboard">
                    <div class="dashboard-item active-item">
                        <a href="/admin">
                            <div class="icon-box"><span class="dashboard-icon7"></span></div>
                            <p>Admin</p>
                        </a>
                    </div>
                </div>
            </div>
            <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>