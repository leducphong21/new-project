<?php

namespace common\models\gara\stock;

use common\models\gara\Product;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_bill_detail".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $detail_id
 * @property integer $bill_id
 * @property integer $product_id
 * @property string $name
 * @property integer $cid
 * @property string $cid_name
 * @property integer $maker_id
 * @property string $maker_name
 * @property integer $repo_id
 * @property string $repo_name
 * @property string $unit
 * @property double $price
 * @property integer $count
 * @property double $discount
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class BillDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_bill_detail';
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
            [['bill_id'], 'required'],
            [['bill_id', 'product_id', 'cid', 'maker_id', 'repo_id', 'count', 'type', 'detail_id', 'status'], 'integer'],
            [['price', 'discount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'cid_name', 'maker_name', 'repo_name'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_id' => 'Phiếu nhập',
            'product_id' => 'Hàng hóa',
            'detail_id' => 'Nhập từ phiếu',
            'type' => 'Loại xuất/nhập',
            'name' => 'Tên hàng hóa',
            'cid' => 'Nhóm hàng',
            'cid_name' => 'Tên nhóm hàng',
            'maker_id' => 'Hãng sản xuất',
            'maker_name' => 'Maker Name',
            'repo_id' => 'Kho hàng',
            'repo_name' => 'Tên kho hàng',
            'unit' => 'Đơn vị',
            'price' => 'Đơn giá',
            'count' => 'Số lượng',
            'discount' => 'Chiết khấu',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->price = str_replace(",", ".", $this->price);
            return true;
        } else {
            return false;
        }
    }

    public function getCPrice(){
       return str_replace(".", ",", $this->price);
    }


    public function getTotal()
    {
        $total = ($this->price * $this->count) * (1 - $this->discount / 100);
        return Yii::$app->formatter->asDecimal($total, 3);
    }

    public function getTotalPrice()
    {
        $total = ($this->product_price * $this->count) * (1 - $this->discount / 100);
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(Bill::className(), ['id' => 'bill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

}
