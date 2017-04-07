<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/3/14
 * Time: 3:14 PM
 */

namespace backend\assets_b;

use yii\web\AssetBundle;

class Project extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web/assets';

    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/weather-icons.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300',
        'http://fonts.googleapis.com/css?family=Roboto:400,300',
        'css/beyond.min.css',
        'css/demo.min.css',
        'css/typicons.min.css',
        'css/animate.min.css',
        //'css/dataTables.bootstrap.css',
        'css/custome.css'
    ];
    public $js = [
        //'js/jquery.min.js',
        'js/skins.min.js',
        'js/bootstrap.min.js',
        'js/slimscroll/jquery.slimscroll.min.js',
        'js/beyond.js',
        'js/libs/bootbox.min.js',
        'js/libs/confirm.js',
        'js/common.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
        'common\assets\Html5shiv'
    ];
}
