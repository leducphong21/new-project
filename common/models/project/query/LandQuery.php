<?php

namespace common\models\project\query;

/**
 * This is the ActiveQuery class for [[\common\models\project\Land]].
 *
 * @see \common\models\project\Land
 */
class LandQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[deleted]]=1');
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Land[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Land|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
