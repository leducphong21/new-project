<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\gara\query;

use common\models\gara\Customer;
use yii\db\ActiveQuery;

class CustomerQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => STATUS_ACTIVE]);
        return $this;
    }

    public function customer()
    {
        $this->andWhere(['type' => Customer::TYPE_CUSTOMER]);
        return $this;
    }

    public function contacter()
    {
        $this->andWhere(['type' => Customer::TYPE_CUSTOMER_CONTACTER]);
        return $this;
    }
}
