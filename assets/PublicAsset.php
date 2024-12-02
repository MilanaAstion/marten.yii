<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/simple-line-icons.css',
        'css/themify-icons.css',
        'css/owl.carousel.min.css',
        'css/slick.css',
        'css/meanmenu.min.css',
        'css/style.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/modernizr-2.8.3.min.js',
        'js/popper.js',
        'js/jquery.counterup.min.js',
        'js/waypoints.min.js',
        'js/elevetezoom.js',
        'js/ajax-mail.js',
        'js/owl.carousel.min.js',
        'js/plugins.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
