<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<p>
    Hi User,
</p>
<br/>
<p>Werlcome!. You password has been successfully reset at <?= yii::$app->params['domainName']?>.
    <br/>
    You new password is <strong><?= $pass?></strong>
    
</p>