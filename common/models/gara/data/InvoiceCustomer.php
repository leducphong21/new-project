<?php

namespace common\models\gara\data;

use Yii;

/**
 * This is the model class for table "d_invoice_customer".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $customer_id
 * @property integer $type
 */
class InvoiceCustomer extends \yii\db\ActiveRecord
{
    const TYPE_OWNER    = 1;
    const TYPE_CUSTOMER    = 2;
    const TYPE_CONTACTER    = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_invoice_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoice_id', 'customer_id'], 'required'],
            [['invoice_id', 'customer_id', 'type'], 'integer'],
            ['customer_id', 'unique', 'targetAttribute' => ['invoice_id', 'customer_id', 'type'], 'message' => 'Người liên hệ đã được sử dụng!'],

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
            'customer_id' => 'Customer ID',
            'type' => 'Type',
        ];
    }
}
