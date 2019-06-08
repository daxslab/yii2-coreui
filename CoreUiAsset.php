<?php

namespace daxslab\coreui;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class CoreUiAsset extends AssetBundle
{
    public $sourcePath = '@daxslab/coreui/assets';
    public $css = [
        "vendors/simple-line-icons/css/simple-line-icons.css",
        "vendors/font-awesome/css/font-awesome.min.css",
        "vendors/pace-progress/css/pace.min.css",
        "css/site.css",
    ];
    public $js = [
        "vendors/pace-progress/js/pace.min.js",
        "vendors/perfect-scrollbar/js/perfect-scrollbar.min.js",
    ];
    public $depends = [
        BaseAsset::class
    ];
}
