<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 8:16 PM
 */

namespace common\assets;

use yii\web\AssetBundle;

class SweetAlertAsset extends AssetBundle
{
    public $sourcePath = null;
    public $css = [
        'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'
    ];
    public $js = [
        'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
