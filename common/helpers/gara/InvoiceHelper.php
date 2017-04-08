<?php
namespace common\helpers\gara;

use common\helpers\DataHelper;
use common\models\gara\Customer;
use common\models\gara\RepositoryReport;
use Yii;
use yii\helpers\Inflector;

class InvoiceHelper extends Inflector
{
    /*
     * Invoice Detail
     * */
    public static function getDetail($id, $update = false)
    {
        $cacheKey = CACHE_CUSTOMER_ITEM . $id;
        $data = dataCache()->get($cacheKey);

        if ($data === false or $update) {
            $data = [];
            /** @var Customer $model */
            $model = Customer::find()->where(['id' => $id])->one();
            if ($model) {
                $data['id'] = $model->id;
                $data['name'] = $model->name;
            }
            /*Set cache*/
            dataCache()->set($cacheKey, $data, 600);
        }
        return $data;
    }


}