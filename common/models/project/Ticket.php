<?php

namespace common\models\project;

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
            [['name_product', 'name_buyer','total_price', 'ticket_price', 'status', 'created_by', 'updated_by','type'], 'integer'],
            [['name_seller','created_at', 'updated_at'], 'safe'],
            [['code', 'code_product', 'code_buyer', 'code_seller'], 'string', 'max' => 8],
            [[ 'address_buyer',  'address_seller'], 'string', 'max' => 255],
            [['mobile_buyer', 'mobile_seller'], 'string', 'max' => 16],
            ['code','required','message'=> 'Số phiếu không được để trống'],
            ['name_product','required','message'=> 'Tên sản phẩm không được để trống'],
            ['code_product','required','message'=> 'Mã sản phẩm không được để trống'],
            ['total_price','required','message'=> 'Tổng giá sản phẩm không được để trống'],
            ['name_seller','required','message'=> 'Tên chủ sở hữu không được để trống'],
            ['code_seller','required','message'=> 'Mã chủ sở hữu không được để trống'],
            ['address_seller','required','message'=> 'Địa chỉ chủ sở hữu không được để trống'],
            ['mobile_seller','required','message'=> 'Điện thoại chủ sở hữu không được để trống'],
            ['name_buyer','required','message'=> 'Tên người mua không được để trống'],
            ['code_buyer','required','message'=> 'Mã người mua không được để trống'],
            ['address_buyer','required','message'=> 'Địa chỉ người mua không được để trống'],
            ['mobile_buyer','required','message'=> 'Điện thoại người mua không được để trống'],
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
            'name_buyer' => 'Người mua',
            'code_buyer' => 'Mã người mua',
            'address_buyer' => 'Địa chỉ NM',
            'mobile_buyer' => 'Điện thoại NM',
            'name_seller' => 'Người bán',
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
        return new \common\models\project\query\TicketQuery(get_called_class());
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
