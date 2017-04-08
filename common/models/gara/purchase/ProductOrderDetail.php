<?php

namespace common\models\gara\purchase;

use common\models\gara\Product;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_product_order_detail".
 *
 * @property integer $id
 * @property integer $product_order_id
 * @property integer $product_id
 * @property string $name
 * @property integer $cid
 * @property string $cid_name
 * @property integer $maker_id
 * @property string $maker_name
 * @property integer $repo_id
 * @property string $repo_name
 * @property integer $repo_status
 * @property string $unit
 * @property double $price
 * @property integer $count
 * @property double $discount
 * @property double $vat
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class ProductOrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_product_order_detail';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_order_id'], 'required'],
            [['product_order_id', 'product_id', 'cid', 'maker_id', 'repo_id', 'repo_status', 'count', 'status'], 'integer'],
            [['price', 'vat', 'discount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'cid_name', 'maker_name'], 'string', 'max' => 255],
            [['repo_name', 'unit'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_order_id' => 'Phiếu mua hàng',
            'product_id' => 'Mã hàng hóa',
            'name' => 'Tên hàng hóa',
            'cid' => 'Cid',
            'cid_name' => 'Nhóm hàng',
            'maker_id' => 'Maker ID',
            'maker_name' => 'Hãng sản xuất',
            'repo_id' => 'Repo ID',
            'repo_name' => 'Kho hàng',
            'repo_status' => 'Trạng thái',
            'unit' => 'Đơn vị tính',
            'price' => 'Giá',
            'count' => 'Số lượng',
            'vat' => 'VAT',
            'discount' => 'Chiết khấu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getTotal()
    {
        $total = ($this->price * $this->count) * (1 - $this->discount / 100);
        return Yii::$app->formatter->asDecimal($total, 3);
    }

    public function getTotalPrice()
    {
        $total = ($this->price * $this->count) * (1 - $this->discount / 100);
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductOrder()
    {
        return $this->hasOne(ProductOrder::className(), ['id' => 'product_order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
