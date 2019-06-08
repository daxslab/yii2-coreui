<?php

namespace daxslab\coreui;

use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CoreUiAsset extends AssetBundle
{
    public $sourcePath = '@vendor/coreui/coreui/dist';
    public $css = [
        "css/coreui.min.css",
    ];
    public $js = [
        "js/coreui.min.js",
        "js/coreui-utilities.min.js",
    ];
    public $depends = [
        BootstrapPluginAsset::class,
    ];
}
