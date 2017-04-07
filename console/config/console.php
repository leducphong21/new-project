<?php
return [
    'id' => 'console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'command-bus' => [
            'class' => 'trntv\bus\console\BackgroundBusController',
        ],
        'message' => [
            'class' => 'console\controllers\ExtendedMessageController'
        ],
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationPath' => '@common/migrations/db',
            'migrationTable' => '{{%system_db_migration}}'
        ],
        'rbac-migrate' => [
            'class' => 'console\controllers\RbacMigrateController',
            'migrationPath' => '@common/migrations/rbac/',
            'migrationTable' => '{{%system_rbac_migration}}',
            'templateFile' => '@common/rbac/views/migration.php'
        ],
        'async-worker' => [
            'class' => 'bazilio\async\commands\AsyncWorkerCommand',
        ],
        'project-migrate' => [
            'class' => 'console\controllers\ProjectMigrateController',
            'migrationPath' => '@common/migrations/project',
            'migrationTable' => '{{%system_project_migration}}'
        ],
        'accouting-migrate' => [
            'class' => 'console\controllers\AccoutingMigrateController',
            'migrationPath' => '@common/migrations/accouting',
            'migrationTable' => '{{%system_accouting_migration}}'
        ],
    ],
];
