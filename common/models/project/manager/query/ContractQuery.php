<?php

namespace common\models\project\manager\query;

/**
 * This is the ActiveQuery class for [[\common\models\project\Contract]].
 *
 * @see \common\models\project\Contract
 */
class ContractQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[deleted]]=1');
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Contract[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Contract|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
