<?php

namespace common\models\accounting\common;
use common\models\User;

use Yii;

/**
 * This is the model class for table "acc_m_money".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property double $exchange_rate
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Money extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acc_m_money';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['exchange_rate'], 'number'],
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 16],
            [['code'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdocaaa
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên tiền tệ',
            'code' => 'Mã tiền tệ',
            'exchange_rate' => 'Tỷ giá',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\accounting\common\query\MoneyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\accounting\common\query\MoneyQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
