<?php

namespace common\models\project\query;

/**
 * This is the ActiveQuery class for [[\common\models\project\Seller]].
 *
 * @see \common\models\project\Seller
 */
class SellerQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[deleted]]=1');
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Seller[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Seller|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
