<?php
use yii\widgets\ActiveForm;
?>
<div class="login">
                            <div class="login-head">
                                <h2>SIGN IN</h2>
                            </div>

                            <div class="popup-body clearfix">
                                <?php
                                    $form = ActiveForm::begin([
                                        'id'=>'login-form',
                                        'method'=>'post',
                                        'fieldConfig'=>[
                                            'template'=>"{label}\n{input}\n{error}"
                                        ]
                                    ]);
                                ?>
                                <?= $form->field($model,'email')->textInput()?>
                                <?= $form->field($model,'password')->passwordInput()?>
                                <input type="submit" value="Sign In" class="btn small-btn submit-btn pull-right">
                                <a href="//<?= yii::$app->params['domainName']?>/site/forgot-pass">Forgot Password</a>
                                <?php $form->end()?>                                
                            </div>

                            <div class="login-footer">
                                <ul>
                                    <li class="login-g-plus">
                                        <a href="#"><em><img src="/designassets/images/logo-google.png" alt=""></em> <span>Sign in with Google</span></a>
                                    </li>
                                    <li class="login-facebook">
                                        <a href="javascript:void(0)" onclick="FeatureTrackFBLogin()"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                                    </li>
                                    <li class="login-twitter">
                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    </li>
                                </ul>	
                            </div>

                            <div class="close-icon"><a href="#"><img src="/designassets/images/cross.png" alt=""></a></div>
                        </div>
