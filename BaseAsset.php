<?php

namespace daxslab\coreui;

use yii\bootstrap4\BootstrapPluginAsset;
use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class BaseAsset extends AssetBundle
{
    public $sourcePath = '@vendor/coreui/coreui/dist';
    public $css = [
        "css/coreui.min.css",
    ];
    public $js = [
        "js/coreui.bundle.js",
    ];
    public $depends = [
        BootstrapPluginAsset::class,
    ];
}
