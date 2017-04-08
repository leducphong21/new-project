<?php

namespace common\models\gara\repair;

use Yii;

/**
 * This is the model class for table "d_invoice_ticket".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $ticket_id
 * @property integer $apply_status
 */
class InvoiceTicket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_invoice_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'ticket_id', 'apply_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Invoice ID',
            'ticket_id' => 'Ticket ID',
            'apply_status' => 'Apply Status',
        ];
    }
}
