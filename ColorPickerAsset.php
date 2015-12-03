<?php

namespace dpodium\colorpicker;

use yii\web\AssetBundle;

class ColorPickerAsset extends AssetBundle {

    public $sourcePath = '@dpodium/colorpicker/assets';
    public $js = [
        'js/colorpicker.js',
    ];
    public $css = [
        'css/colorpicker.css',
        'css/custom-colorpicker.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
