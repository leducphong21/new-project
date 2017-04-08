<?php

namespace common\models\gara\repair;

use Yii;

/**
 * This is the model class for table "d_costing_customer".
 *
 * @property integer $id
 * @property integer $costing_id
 * @property integer $customer_id
 * @property integer $type
 */
class CostingCustomer extends \yii\db\ActiveRecord
{
    const TYPE_OWNER    = 1;
    const TYPE_CUSTOMER    = 2;
    const TYPE_CONTACTER    = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_costing_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['costing_id', 'customer_id', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'costing_id' => 'Costing ID',
            'customer_id' => 'Contacter ID',
            'type' => 'Type',
        ];
    }
}
