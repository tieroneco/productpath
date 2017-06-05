<?php

use yii\widgets\ActiveForm;
?>

<div class="login notice">
    <div class="notice-inner">
        <?php
        $session = yii::$app->session;
        switch ($session->getFlash('notice')) {
            case 'REGSUCCESS':
                ?>
                <div class="reg-notice">
                    <h3>Please Confirm your email</h3>
                    <p> We have sent you a validation email to</p>
                    <br/>
                    <span class="toemail"><?= $session->getFlash('email') ?></span>
                    <br/>
                    <p> Please validate your email address in order to get started <p/>
<!-- This p is experimental as the email is not working, once the email works this p will automatically removed-->
                   <?php
                        if($session->hasFlash('mail_sent') && $session->getFlash('mail_sent')=='No'){
                            ?>
                    <p class="email-click">
                        <?= $session->getFlash('registrationdone')?>
                    </p><?php
                    $session->getFlash('registrationdone');
                        }
                   ?>

                </div>        
            <?php
        }
        ?>
    </div>
</div>
