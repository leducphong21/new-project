<?php
/**
 * Require core files
 */
require_once(__DIR__ . '/../helpers.php');

/**
 * Setting path aliases
 */
Yii::setAlias('@base', realpath(__DIR__.'/../../'));
Yii::setAlias('@common', realpath(__DIR__.'/../../common'));
Yii::setAlias('@frontend', realpath(__DIR__.'/../../frontend'));
Yii::setAlias('@backend', realpath(__DIR__.'/../../backend'));
Yii::setAlias('@accounting', realpath(__DIR__.'/../../accounting'));
Yii::setAlias('@console', realpath(__DIR__.'/../../console'));
Yii::setAlias('@storage', realpath(__DIR__.'/../../storage'));
Yii::setAlias('@api', realpath(__DIR__.'/../../api'));

/**
 * Setting url aliases
 */
Yii::setAlias('@frontendUrl', env('FRONTEND_URL'));
Yii::setAlias('@backendUrl', env('BACKEND_URL'));
Yii::setAlias('@accountingUrl', env('ACCOUNTING_URL'));
Yii::setAlias('@storageUrl', env('STORAGE_URL'));
Yii::setAlias('@apiUrl', env('API_URL'));

/*Define Cache Constrant*/
define('STATUS_ACTIVE', 1);
define('STATUS_NONACTIVE', 0);

define('CACHE_USER_DETAIL', 'ud');
define('CACHE_ARTICLE_ITEM', 'ai');
define('CACHE_GARAGE_TICKET_ITEM', 'rt');
define('CACHE_GARAGE_INVOICE_ITEM', 'ri');
define('CACHE_GARAGE_COMMAND_ITEM', 'rr');
define('CACHE_GARAGE_COSTING_ITEM', 'rc');

define('CACHE_PRODUCT_ITEM', 'dp');
define('CACHE_CAR_ITEM', 'dc');
define('CACHE_CUSTOMER_ITEM', 'ci');
define('CACHE_INVOICE_ITEM', 'di');
define('CACHE_TICKET_ITEM', 'dt');

