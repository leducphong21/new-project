<?php

namespace common\helpers\gara;

use common\helpers\DataHelper;
use common\models\gara\Car;
use common\models\gara\CarCarry;
use common\models\gara\CarModel;
use common\models\gara\Customer;
use common\models\gara\store\BillDetail;
use yii\helpers\ArrayHelper;
use Yii;
use yii\helpers\Inflector;

class TicketHelper extends Inflector
{
    public static function getDetail($id, $update = false)
    {
        $cacheKey = CACHE_GARAGE_TICKET_ITEM . $id;
        $data = dataCache()->get($cacheKey);

        if ($data === false or $update) {
            $data = [];


            /*Set cache*/
            dataCache()->set($cacheKey, $data, 600);
        }
        return $data;
    }
}