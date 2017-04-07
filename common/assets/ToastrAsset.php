<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class ToastrAsset extends AssetBundle
{
    public $sourcePath = null;
    public $css = [
        'http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css'
    ];
    public $js = [
        'http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
