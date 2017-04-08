<?php

namespace common\models\gara\repair;

use Yii;

/**
 * This is the model class for table "d_ticket_customer".
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $customer_id
 * @property integer $type
 */
class TicketCustomer extends \yii\db\ActiveRecord
{
    const TYPE_OWNER    = 1;
    const TYPE_CUSTOMER    = 2;
    const TYPE_CONTACTER    = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_ticket_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_id', 'customer_id'], 'required'],
            [['ticket_id', 'customer_id', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'customer_id' => 'Customer ID',
            'type' => 'Type',
        ];
    }
}
