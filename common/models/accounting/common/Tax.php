<?php

namespace common\models\accounting\common;

use common\models\User;
use Yii;

/**
 * This is the model class for table "acc_m_tax".
 *
 * @property integer $id
 * @property string $name
 * @property string $tax_code
 * @property string $tariff
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Tax extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acc_m_tax';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'tax_code'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'tax_code', 'tariff'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên thuế',
            'tax_code' => 'Mã thuế',
            'tariff' => 'Thuế suất',
            'created_by' => 'Người tạo',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
//            'updated_by' => 'Updated By',
        ];
    }
    //get author
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
