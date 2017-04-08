<?php

namespace common\models\gara\repair;

use common\models\gara\Product;
use common\models\gara\Service;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_repair_command_detail".
 *
 * @property integer $id
 * @property integer $repair_command_id
 * @property integer $type
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
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 */
class RepairCommandDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_repair_command_detail';
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
            [['repair_command_id'], 'required'],
            [['repair_command_id', 'type', 'product_id', 'cid', 'maker_id', 'repo_id', 'count', 'status', 'repo_status'], 'integer'],
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
            'repair_command_id' => 'Repair Command ID',
            'type' => 'Type',
            'product_id' => 'Product ID',
            'name' => 'Tên hàng hóa',
            'cid' => 'Mã hàng hóa',
            'cid_name' => 'Cid Name',
            'maker_id' => 'Hãng sản xuất',
            'maker_name' => 'Maker Name',
            'repo_id' => 'Kho hàng',
            'repo_name' => 'Repo Name',
            'repo_status' => 'Trạng thái',
            'unit' => 'Đơn vị',
            'price' => 'Giá',
            'count' => 'Số lượng',
            'discount' => 'Chiết khấu',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getStatusText()
    {
        if ($this->repo_status) {
            return 'Còn hàng';
        }
        return 'Hết hàng';
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
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'product_id']);
    }
}
