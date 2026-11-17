<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class WonderAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/../themes/wonder';
    public $css = [
        '//fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900',
        '//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i',
        'css/one-page-wonder.min.css',
		'fontawesome/css/all.min.css'
    ];
    public $js = [
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}