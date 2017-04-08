<?php

namespace common\models\gara\repair;

use common\models\gara\Product;
use common\models\gara\RepositoryReport;
use common\models\gara\Service;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_invoice_detail".
 *
 * @property integer $id
 * @property integer $invoice_id
 * @property string $name
 * @property integer $type
 * @property integer $product_id
 * @property string $product_name
 * @property string $product_cid_name
 * @property integer $product_cid
 * @property integer $product_maker_id
 * @property string $product_maker_name
 * @property integer $product_repo_id
 * @property string $product_repo_name
 * @property integer $product_repo_status
 * @property integer $product_unit
 * @property double $product_price
 * @property integer $count
 * @property integer $discount
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class InvoiceDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_invoice_detail';
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
            [['invoice_id', 'name'], 'required'],
            [['invoice_id', 'type', 'product_id', 'product_cid', 'product_maker_id', 'product_repo_id', 'count', 'product_repo_status'], 'integer'],
            [['product_price', 'discount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            ['count', 'compare', 'compareValue' => 1, 'operator' => '>=', 'type' => 'number'],
            [['name', 'product_name', 'product_cid_name', 'product_unit', 'product_cid_name', 'product_maker_name', 'product_repo_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'invoice_id' => 'Hóa đơn',
            'name' => 'Tên hàng hóa',
            'type' => 'Loại',
            'product_id' => 'Mã hàng hóa',
            'product_name' => 'Tên hàng hóa',
            'product_cid' => 'Danh mục hàng hóa',
            'product_maker_id' => 'HSX',
            'product_maker_name' => 'HSX',
            'product_repo_id' => 'Kho hàng',
            'product_repo_name' => 'Kho hàng',
            'product_repo_status' => 'Trạng thái',
            'product_unit' => 'ĐVT',
            'product_price' => 'Đơn giá',
            'product_cid_name' => 'Nhóm hàng',
            'count' => 'Số lượng',
            'discount' => 'Chiết khẩu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getStatusText()
    {
        if ($this->product_repo_status) {
            return 'Còn hàng';
        }
        return 'Hết hàng';
    }

    public function getTotal()
    {
        $total = ($this->product_price * $this->count) * (1 - $this->discount / 100);
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
    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepo()
    {
        return $this->hasOne(RepositoryReport::className(), ['id' => 'product_repo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'product_id']);
    }
}
