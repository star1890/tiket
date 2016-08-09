<?php

/**
 * @company PT. Bank BRISyariah
 * @author bintang
 * @date Apr 22, 2016
 */

namespace app\assets;

use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/login-form/';
    public $css = [
        'css/style.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}

