<?php

/**
 * @company PT. Bank BRISyariah
 * @author bintang
 * @date Apr 21, 2016
 */

namespace app\assets;

use yii\web\AssetBundle;

class GentelellaAsset extends AssetBundle
{
    public $sourcePath = '@vendor/gentelella/';
    public $css = [
        'css/animate.min.css',
        'css/custom.css',
    ];
    public $js = [
        'js/nicescroll/jquery.nicescroll.min.js',
        'js/custom.js',
        'js/accounting.min.js',
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}