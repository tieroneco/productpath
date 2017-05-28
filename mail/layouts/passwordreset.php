<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    Hi User,
</p>
<br/>
<p>Werlcome!. You password has been successfully reset at <?= yii::$app->params['domainName']?>.
    Your product site is <b><?= $site->subDomain?></b>.Please <a href="<?= Url::to(['site/activate/?q='.$user->activationKey], true)?>">click</a>
here to activate your account.
<br/>
If you are unable to click on the link then please copy & paste the below 
<br/>
<?= Url::to(['site/activate/'.$user->activationKey], true)?>
</p>