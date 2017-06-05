<?php
use yii\widgets\ActiveForm;
?>
<div class="login forgotpass">
                            <div class="login-head">
                                <h2>FORGOT PASSWORD</h2>
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
                                
                                <input type="submit" value="Sign In" class="btn small-btn submit-btn pull-right">
                                <?php $form->end()?>                                
                            </div>
                            <?php
                            $this->params['context'] = '<div  class="creat_acount_link"><a href="/site/login">Sign In</a></div>';
                            
                            ?>

                            <div class="close-icon"><a href="/"><img src="/designassets/images/cross.png" alt=""></a></div>
                        </div>
