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
class AppAdminAsset extends AssetBundle
{
    public $basePath = '@webroot/designassets';
    public $baseUrl = '@web/designassets';
    public $css = [        
        
        'css/colorpicker.css',
        'css/admin.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/colorpicker.js'
    ];
    public $depends = [
        'app\assets\AppAsset'
    ];
}
