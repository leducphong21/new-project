<?php

namespace common\models\accounting\common\query;

/**
 * This is the ActiveQuery class for [[\common\models\accounting\common\Employees]].
 *
 * @see \common\models\accounting\common\Employees
 */
class EmployeesQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * @inheritdoc
     * @return \common\models\accounting\common\Employees[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\accounting\common\Employees|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
