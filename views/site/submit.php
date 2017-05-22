<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="innerpage-body">  
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-xs-push-3">
                <div class="submit-feature-idea">
                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'submit-form',
                                'options' => ['method' => 'post'],
                                'fieldConfig' => ['template' =>
                                    "<div class=\"col-lg-6 col-md-6 col-sm-12 col-xs-12\">"
                                    . "<label>{label}</label>\n{input}\n{error}</div>"
                                ]
                    ]);
                    ?>
                    <div>
                        <?=
                        $form->field($ideaModel, 'title', [
                            'template' => "{label}\n{input}{error}"
                        ])->textInput()
                        ?>

                        <?=
                        $form->field($ideaModel, 'body', [
                            'template' => "{label}\n{input}{error}"
                        ])->textArea()
                        ?>

                        <?=
                        $form->field($ideaUserModel, 'email', [
                            'template' => '{label}' . "\n" . '<div class="social-login-box clearfix">{input}<div class="social-icon-box">Or sign in <a href="#"><img src="images/fa.png"></a><a href="#"><img src="images/twi.png"></a><a href="#"><img src="images/gool.png"></a>                                 	
                                </div>' . "\n" . '{error}</div>'
                        ])->textInput(['class' => ['form-control mediumwidth']])
                        ?>
                        <?=
                        $form->field($ideaUserModel, 'name', [
                            'template' => "{label}\n{input}\n{error}"
                        ])->textInput()
                        ?>

                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                <div class="check-area">
                                    <?= $form->field($ideaModel,'receieveEmail',['template'=>'{input}'
                                        . '<label class="checkbox-label pull-left" for="idea-receieveemail">I\'d like to receieve email updates when this idea receives comments. Unsubscribe at anytime</label>'
                                        ])->checkBox(['label'=>false], false)?>                                    
                                    
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <input type="submit" class="submit-btn pull-right  mid-btn" value="Submit Idea">
                            </div>
                        </div>
                    </div>
<?php
ActiveForm::end();
?>
                    <style>
                        .field-ideauser-email .help-block{
                            float:left;
                        }
                    </style>                   

                    <div class="return-ideas">
                        <a href="/">Return to Ideas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>