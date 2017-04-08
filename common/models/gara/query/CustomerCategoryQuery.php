<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/4/14
 * Time: 2:31 PM
 */

namespace common\models\gara\query;

use yii\db\ActiveQuery;

class CustomerCategoryQuery extends ActiveQuery
{
    public function active()
    {
        $this->andWhere(['status' => STATUS_ACTIVE]);
        return $this;
    }
}
