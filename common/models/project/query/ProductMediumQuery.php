<?php

namespace common\models\project\query;

/**
 * This is the ActiveQuery class for [[\common\models\project\Product]].
 *
 * @see \common\models\project\ProductMedium
 */
class ProductMediumQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[deleted]]=1');
    }

    /**
     * @inheritdoc
     * @return \common\models\project\ProductMedium[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\project\ProductMedium|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
