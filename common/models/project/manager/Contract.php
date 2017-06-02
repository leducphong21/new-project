<?php

namespace common\models\project\manager;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_contract".
 *
 * @property integer $id
 * @property string $code
 * @property string $code_product
 * @property string $name_product
 * @property integer $total_price
 * @property string $name_buyer
 * @property string $code_buyer
 * @property string $address_buyer
 * @property string $mobile_buyer
 * @property string $name_seller
 * @property string $code_seller
 * @property string $address_seller
 * @property string $mobile_seller
 * @property string $handover_dateline
 * @property string $guarantee
 * @property string $renter_dateline
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $name;
    public static function tableName()
    {
        return 'm_contract';
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
            [['total_price', 'created_by', 'updated_by','deleted','ticket_id'], 'integer'],
            [['handover_dateline', 'renter_dateline', 'created_at', 'updated_at'], 'safe'],
            [['code', 'code_product', 'code_buyer', 'code_seller'], 'string', 'max' => 8],
            [['name_product', 'name_buyer', 'address_buyer', 'name_seller', 'address_seller'], 'string', 'max' => 255],
            [['mobile_buyer', 'mobile_seller'], 'string', 'max' => 16],
            [['guarantee'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Số hợp đồng',
            'code_product' => 'Mã sản phẩm',
            'name_product' => 'Tên sản phẩm',
            'total_price' => 'Tổng giá',
            'name_buyer' => 'Tên người mua',
            'code_buyer' => 'Mã người mua',
            'address_buyer' => 'Địa chỉ người mua',
            'mobile_buyer' => 'Điện thoại người mua',
            'name_seller' => 'Tên người bán',
            'code_seller' => 'Mã người bán',
            'address_seller' => 'Địa chỉ người bán',
            'mobile_seller' => 'Điện thoại người bán',
            'handover_dateline' => 'Thời hạn bàn giao',
            'guarantee' => 'Bảo hành',
            'renter_dateline' => 'Thời hạn thuê',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_by' => 'Người sửa',
            'updated_at' => 'Ngày sửa',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\project\query\ContractQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\project\query\ContractQuery(get_called_class());
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
