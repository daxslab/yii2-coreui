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
        "css/site.css",
    ];
    public $js = [
    ];
    public $depends = [
        BaseAsset::class
    ];
}
