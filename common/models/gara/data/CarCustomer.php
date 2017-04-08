<?php

namespace common\models\gara\data;

use common\models\gara\Car;
use common\models\gara\Customer;
use Yii;

/**
 * This is the model class for table "m_car_customer".
 *
 * @property integer $id
 * @property integer $car_id
 * @property integer $customer_id
 * @property integer $type
 */
class CarCustomer extends \yii\db\ActiveRecord
{
    const TYPE_OWNER    = 1;
    const TYPE_CUSTOMER    = 2;
    const TYPE_CONTACTER    = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_car_customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['car_id', 'customer_id'], 'required'],
            [['car_id', 'customer_id', 'type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'customer_id' => 'Customer ID',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
