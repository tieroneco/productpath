<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    Hi User,
</p>
<br/>
<p>Werlcome!. You have successfully registered at <?= yii::$app->params['domainName']?>.
    Your product site is <b><?= $model->host?></b>.Please <a href="<?= Url::to(['site/activate/'.$user->activattionKey], true)?>">click</a>
here to activate your account.
<br/>
If you are unable to click on the link then please copy & paste the below 
<br/>
<?= Url::to(['site/activate/'.$user->activattionKey], true)?>
</p>

