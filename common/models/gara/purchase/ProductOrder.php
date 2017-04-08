<?php

namespace common\models\gara\purchase;

use common\models\gara\Supply;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_product_order".
 *
 * @property integer $id
 * @property string $no
 * @property string $date
 * @property string $date_order
 * @property string $created_name
 * @property integer $supply_id
 * @property string $address_delivery
 * @property integer $pay_type
 * @property integer $order_status
 * @property double $vat
 * @property double $discount
 * @property string $note
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class ProductOrder extends \yii\db\ActiveRecord
{
    public $total_price;
    public $has_product;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_product_order';
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
            [['no', 'supply_id', 'has_product'], 'required'],
            [['date', 'date_order', 'created_at', 'updated_at'], 'safe'],
            [['supply_id', 'pay_type', 'order_status', 'status', 'created_by', 'updated_by'], 'integer'],
            [['vat', 'discount'], 'number'],
            [['note'], 'string'],
            [['no', 'created_name'], 'string', 'max' => 32],
            [['address_delivery'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => 'Số hóa đơn',
            'date' => 'Ngày hóa đơn',
            'date_order' => 'Ngày giao hàng',
            'created_name' => 'Người lập phiếu',
            'supply_id' => 'Nhà cung cấp',
            'address_delivery' => 'Địa chỉ giao hàng',
            'pay_type' => 'Thanh toán',
            'order_status' => 'Trạng thái',
            'vat' => 'Thuế VAT',
            'discount' => 'Chiết khấu/Khuyến mãi',
            'note' => 'Diễn giải',
            'total_price' => 'Tổng tiền',
            'status' => 'Trạng thái',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupply()
    {
        return $this->hasOne(Supply::className(), ['id' => 'supply_id']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(ProductOrderDetail::className(), ['product_order_id' => 'id']);
    }

    public function getTotal(){
        return 500000000;
    }

    public function getTotalPrice()
    {
        $dataDetails = $this->details;
        $total = 0;
        foreach ($dataDetails as $item) {
            $total = $total + $item->totalPrice;
        }
        return $total;
    }
}
