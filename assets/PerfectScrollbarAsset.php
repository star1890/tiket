<?php

/**
 * @company PT. Bank BRISyariah
 * @author bintang
 * @date Apr 22, 2016
 */

namespace app\assets;

use yii\web\AssetBundle;

class PerfectScrollbarAsset extends AssetBundle
{
    public $sourcePath = '@vendor/perfect-scrollbar/';
    public $css = [
        'css/perfect-scrollbar.min.css',
    ];
    public $js = [
        'js/perfect-scrollbar.jquery.min.js',
    ];
    public $depends = [
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}

