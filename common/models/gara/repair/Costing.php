<?php

namespace common\models\gara\repair;

use common\models\gara\Car;
use common\models\gara\Customer;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_costing".
 *
 * @property integer $id
 * @property integer $car_id
 * @property integer $customer_id
 * @property integer $contacter_id
 * @property string $note
 * @property double $vat
 * @property double $discount
 * @property integer $has_apply
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Costing extends \yii\db\ActiveRecord
{
    public $has_rcommand;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_costing';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id', 'customer_id', 'has_rcommand'], 'required'],
            [['car_id', 'customer_id', 'contacter_id', 'has_apply', 'status', 'created_by', 'updated_by'], 'integer'],
            [['note'], 'string'],
            [['vat', 'discount'], 'number'],
            [['contacter_name'], 'string', 'max' => 255],
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
            'car_id' => 'Xe',
            'has_rcommand' => 'Lệnh sửa chữa',
            'customer_id' => 'Khách hàng',
            'contacter_id' => 'Người liên hệ',
            'contacter_name' => 'Người liên hệ',
            'note' => 'Diễn giải',
            'vat' => 'Thuế VAT',
            'discount' => 'Chiết khấu/Khuyến mãi',
            'has_apply' => 'Has Apply',
            'status' => 'Status',
            'created_by' => 'Create By',
            'updated_by' => 'Update By',
            'created_at' => 'Create At',
            'updated_at' => 'Update At',
        ];
    }

    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(CostingDetail::className(), ['costing_id' => 'id']);
    }

    /**
     * Select First Contacter
     * @return \yii\db\ActiveQuery
     */
    public function getContacter()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_costing_customer', ['costing_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 3]);
                });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacters()
    {
        return $this->hasMany(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_costing_customer', ['costing_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 3]);
                });
    }

    public function total(){

    }


}
