<?php

namespace api\controllers;

use api\components\AccessTokenAuth;
use yii\filters\AccessControl;

class ProductController extends ApiController
{

    public function actionIndex()
    {
        $this->msg = 'Product Controller';
    }

    public function actionUser()
    {

        $this->msg = 'User login demo';
        $this->data = \Yii::$app->getUser()->getId();
    }
}
