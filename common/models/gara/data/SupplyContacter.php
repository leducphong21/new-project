<?php

namespace common\models\gara\data;

use Yii;

/**
 * This is the model class for table "d_supply_contacter".
 *
 * @property integer $id
 * @property integer $supply_id
 * @property integer $contacter_id
 */
class SupplyContacter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'd_supply_contacter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['supply_id', 'contacter_id'], 'required'],
            [['supply_id', 'contacter_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'supply_id' => 'Supply ID',
            'contacter_id' => 'Contacter ID',
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
