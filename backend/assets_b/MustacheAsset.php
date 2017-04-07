<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets_b;

use yii\web\AssetBundle;

class MustacheAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web/js/libs/mustache';

    public $js = [
        'mustache.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
