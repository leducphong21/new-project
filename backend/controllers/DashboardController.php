<?php

namespace backend\controllers;

use common\models\gara\Customer;
use common\models\gara\repair\Invoice;
use common\models\gara\repair\RepairCommand;
use yii\data\ActiveDataProvider;

class DashboardController extends AdminController
{
    public function actionIndex()
    {
        return $this->render('index');
    }



}
