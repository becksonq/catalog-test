<?php


namespace frontend\assets;


use yii\web\AssetBundle;

/**
 * Ресурсы для иконок Bootstrap 5
 * @see https://icons.getbootstrap.com/
 *
 * Class BootstapIconAsset
 * @package frontend\assets
 */
class BootstapIconAsset extends AssetBundle
{
    public $sourcePath = '@npm/bootstrap-icons';

    public $css = [
        'font/bootstrap-icons.css',
    ];
}