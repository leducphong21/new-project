<?php
return [
    'class'=>'yii\web\UrlManager',
    'enablePrettyUrl'=>true,
    'showScriptName'=>false,
    'rules'=>[
        // url rules
        ['pattern'=>'log', 'route'=>'system/log'],
        ['pattern'=>'car-error', 'route'=>'other/error'],

    ]
];
