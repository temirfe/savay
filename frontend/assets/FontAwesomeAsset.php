<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 *
 * Class FontAwesomeAsset
 * @package common\assets\fontAwesome
 */
class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
}