<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/designassets';
    public $baseUrl = '@web/designassets';
    public $css = [        
        'css/bootstrap.css',
        'css/custom.css',
        //'css/responsive.css',
        'css/jquery.minicolors.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'
    ];
    public $js = [
        'js/bootstrap.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
       // 'yii\bootstrap\BootstrapAsset',
    ];
    
    public function init() {
        
    }
}
