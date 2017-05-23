<?php

namespace common\models\project\manager;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_ticket".
 *
 * @property integer $id
 * @property string $code
 * @property string $code_product
 * @property string $name_product
 * @property integer $total_price
 * @property integer $ticket_price
 * @property integer $status
 * @property string $name_buyer
 * @property string $code_buyer
 * @property string $address_buyer
 * @property string $mobile_buyer
 * @property string $name_seller
 * @property string $code_seller
 * @property string $address_seller
 * @property string $mobile_seller
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Ticket extends \yii\db\ActiveRecord
{
    public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_ticket';
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
            [['name_seller','name_product', 'name_buyer','total_price', 'ticket_price', 'status', 'created_by', 'updated_by','type'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['code', 'code_product', 'code_buyer', 'code_seller'], 'string', 'max' => 8],
            [[ 'address_buyer',  'address_seller'], 'string', 'max' => 255],
            [['mobile_buyer', 'mobile_seller'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Mã phiếu',
            'type' => 'Loại',
            'code_product' => 'Mã SP',
            'name_product' => 'Tên SP',
            'total_price' => 'Tổng giá',
            'ticket_price' => 'Đặt cọc',
            'status' => 'Tình trạng',
            'name_buyer' => 'Tên người mua',
            'code_buyer' => 'Mã người mua',
            'address_buyer' => 'Địa chỉ NM',
            'mobile_buyer' => 'Điện thoại NM',
            'name_seller' => 'Tên người bán',
            'code_seller' => 'Mã người bán',
            'address_seller' => 'Địa chỉ NB',
            'mobile_seller' => 'Điện thoại NB',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_by' => 'Người sửa',
            'updated_at' => 'Ngày sửa',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\project\query\TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\project\manager\query\TicketQuery(get_called_class());
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'name_product']);
    }
    public function getSeller()
    {
        return $this->hasOne(Seller::className(), ['id' => 'name_seller']);
    }
    public function getBuyer()
    {
        return $this->hasOne(Buyer::className(), ['id' => 'name_buyer']);
    }

}
