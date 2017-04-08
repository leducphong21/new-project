<?php

namespace common\helpers\gara;

use common\helpers\DataHelper;
use common\helpers\SystemHelper;
use common\models\gara\Car;
use common\models\gara\CarCarry;
use common\models\gara\CarModel;
use common\models\gara\Customer;
use common\models\gara\stock\BillDetail;
use yii\helpers\ArrayHelper;
use Yii;
use yii\helpers\Inflector;

class OtherHelper extends Inflector
{
    public static function getBillArray($product_id)
    {

        $dataBill = BillDetail::find()
            //->select('ANY_VALUE(id) AS id, repo_id, product_id ANY_VALUE(repo_name) as repo_name') //Mysql 5.7
            //->select(['id', 'repo_id', 'product_id', 'repo_name'])
            ->where(['product_id' => $product_id, 'status' => STATUS_ACTIVE])
            ->groupBy('repo_id')
            ->asArray();

        //Process case Mysql Is 5.7
        if (SystemHelper::isMysql57()) {
            $dataBill->select('ANY_VALUE(id) AS id, repo_id, product_id ANY_VALUE(repo_name) as repo_name'); //Mysql 5.7
        } else {
            $dataBill->select(['id', 'repo_id', 'product_id', 'repo_name']);
        }

        return $dataBill->all();
    }
}