<?php

namespace common\models\project\manager\query;

/**
 * This is the ActiveQuery class for [[\common\models\project\Ticket]].
 *
 * @see \common\models\project\Ticket
 */
class TicketQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[status]]=0');
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Ticket[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\project\Ticket|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
