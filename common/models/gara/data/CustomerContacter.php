<?php

namespace common\models\gara\data;

use Yii;

/**
 * This is the model class for table "d_customer_contacter".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $contacter_id
 */
class CustomerContacter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_customer_contacter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'contacter_id'], 'required'],
            [['customer_id', 'contacter_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Tên khách hàng',
            'contacter_id' => 'Người liên hệ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'contacter_id']);
    }
}
