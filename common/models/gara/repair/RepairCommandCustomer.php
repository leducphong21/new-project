<?php

namespace common\models\gara\repair;

use Yii;

/**
 * This is the model class for table "d_repair_command_customer".
 *
 * @property integer $id
 * @property integer $repair_command_id
 * @property integer $customer_id
 * @property integer $type
 */
class RepairCommandCustomer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_repair_command_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repair_command_id', 'customer_id'], 'required'],
            [['repair_command_id', 'customer_id', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'repair_command_id' => 'Repair Command ID',
            'customer_id' => 'Customer ID',
            'type' => 'Type',
        ];
    }
}
