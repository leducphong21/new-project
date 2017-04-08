<?php

namespace common\models\gara\repair;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_costing_detail".
 *
 * @property integer $id
 * @property integer $costing_id
 * @property integer $repair_command_id
 * @property string $created_at
 * @property string $updated_at
 */
class CostingDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_costing_detail';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['costing_id'], 'required'],
            [['costing_id', 'repair_command_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'repair_command_id' => 'Repair Command ID',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCosting()
    {
        return $this->hasOne(Costing::className(), ['id' => 'costing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairCommand()
    {
        return $this->hasOne(RepairCommand::className(), ['id' => 'repair_command_id']);
    }
}
