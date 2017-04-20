<?php

namespace common\models\project;

/**
 * This is the ActiveQuery class for [[Project]].
 *
 * @see ModelProject
 */
class ProjectQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[deleted]]=1');
    }

    /**
     * @inheritdoc
     * @return ModelProject[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ModelProject|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
