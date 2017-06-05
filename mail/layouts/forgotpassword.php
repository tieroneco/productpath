<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    Hi User,
</p>
<br/>
<p>Werlcome!. Your password reset request has been successfully registered at <?= yii::$app->params['domainName']?>.
    Please <a href="<?= Url::to(['site/resetpass/?q='.$user->activationKey], true)?>">click</a> here to reset your passowrd.
<br/>
If you are unable to click on the link then please copy & paste the below 
<br/>
<?= Url::to(['site/resetpass/?q='.$user->activationKey], true)?>
</p>
<p> 
    If it's not you please ignore the email.
</p>

