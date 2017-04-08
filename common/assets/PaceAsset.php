<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class PaceAsset extends AssetBundle
{
    public $sourcePath = '@bower/pace';
    public $js = [
        'pace.flot.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
