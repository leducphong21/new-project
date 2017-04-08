<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets_b;

use yii\web\AssetBundle;

class PreviewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web/preview';

    public $css = [
        //'css/style.css',
        //'css/invoice1.css',
    ];
    public $js = [
        'js/app.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
