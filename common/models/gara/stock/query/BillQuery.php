<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\gara\stock\query;

use yii\db\ActiveQuery;

class BillQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => STATUS_ACTIVE]);
        return $this;
    }
}
