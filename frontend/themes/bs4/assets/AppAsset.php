<?php


namespace frontend\themes\bs4\assets;


class AppAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@frontend/themes/bs4/web';

    public $css = [];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];
}