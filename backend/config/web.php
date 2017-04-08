<?php
$config = [
    'homeUrl' => Yii::getAlias('@backendUrl'),
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'dashboard/index',
    'controllerMap' => [
        'file-manager-elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['manager'],
            'disabledCommands' => ['netmount'],
            'roots' => [
                [
                    'baseUrl' => '@storageUrl',
                    'basePath' => '@storage',
                    'path' => '/',
                    'access' => ['read' => 'manager', 'write' => 'manager']
                ]
            ]
        ]
    ],
    'components' => [
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'request' => [
            'cookieValidationKey' => 'sdfsd'
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'loginUrl' => ['sign-in/login'],
            'enableAutoLogin' => true,
            //'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                ],
                'common\assets\AdminLte' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.3.6/'
                ],
                'common\assets\FontAwesome' => [
                    'sourcePath' => null,
                    'css' => [
                        'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css',
                    ]
                ],
                'common\assets\Html5shiv' => [
                    'sourcePath' => null,
                    'css' => [
                        'https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js',
                    ]
                ],
                'common\assets\Flot' => [
                    'sourcePath' => null,
                    'css' => [
                        'https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.js',
                    ]
                ],
                'common\assets\JquerySlimScroll' => [
                    'sourcePath' => null,
                    'js' => [
                        'https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js',
                    ]
                ],
                'trntv\filekit\widget\BlueimpFileuploadAsset' => [
                    'sourcePath' => null,
                    'baseUrl' => 'https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/9.12.5/'
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => ['https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js',]
                ],

            ],
        ],
    ],
    'modules' => [
        'system' => [
            'class' => 'backend\modules\system\Module',
        ],
        'category' => [
            'class' => 'backend\modules\category\Module',
        ],
    ],
    'as globalAccess' => [
        'class' => '\common\behaviors\GlobalAccessBehavior',
        'rules' => [
            [
                'controllers' => ['sign-in'],
                'allow' => true,
                'roles' => ['?'],
                'actions' => ['login', 'request-password-reset']
            ],
            [
                'controllers' => ['sign-in'],
                'allow' => true,
                'roles' => ['@'],
                'actions' => ['logout']
            ],
            [
                'controllers' => ['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions' => ['error']
            ],

            [
                'controllers' => ['user'],
                'allow' => true,
                'roles' => ['administrator'],
            ],

            [
                'allow' => true,
                'roles' => ['user'],
            ]
        ]
    ]
];

if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates')
                ],
                'template' => 'yii2-starter-kit',
                'messageCategory' => 'backend'
            ]
        ]
    ];
}

return $config;
