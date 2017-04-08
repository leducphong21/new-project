<?php

namespace common\models\gara\repair;

use Yii;

/**
 * This is the model class for table "d_repair_command_invoice".
 *
 * @property integer $id
 * @property integer $repair_command_id
 * @property integer $invoice_id
 * @property integer $apply_status
 */
class RepairCommandInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_repair_command_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repair_command_id', 'invoice_id', 'apply_status'], 'integer'],
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
            'invoice_id' => 'Invoice ID',
            'apply_status' => 'Apply Status',
        ];
    }
}
