<?php
namespace app\modules\main;

class Module extends \yii\base\Module{
    
    public function init() {
        parent::init();
        \yii::configure($this, require(__DIR__ . '/config/config.php'));
    }
}