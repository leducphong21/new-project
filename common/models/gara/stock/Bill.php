<?php

namespace common\models\gara\stock;

use common\models\gara\RepositoryReport;
use common\models\gara\stock\query\BillQuery;
use common\models\gara\Supply;
use common\models\other\BillType;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_bill".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $input_type
 * @property integer $suplly_id
 * @property string $coupon_id
 * @property string $document_id
 * @property integer $invoice_number
 * @property string $date
 * @property string $note
 * @property string $created_name
 * @property double $vat
 * @property double $discount
 * @property integer $from_id
 * @property integer $to_id
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Bill extends \yii\db\ActiveRecord
{
    const SCENARIO_ONE = 'one';
    const SCENARIO_TWO = 'two';

    public $total_price;
    public $has_product;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_bill';
    }

    /**
     * @return BillQuery
     */
    public static function find()
    {
        return new BillQuery(get_called_class());
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
            [['suplly_id', 'document_id'], 'required', 'on' => self::SCENARIO_ONE],
            [['from_id', 'to_id', 'document_id'], 'required', 'on' => self::SCENARIO_TWO],
            [['input_type'], 'required', 'message' => 'Vui lòng chọn loại nhập kho', 'on' => self::SCENARIO_ONE],
            [['type', 'from_id', 'to_id', 'input_type', 'suplly_id', 'invoice_number', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['note'], 'string'],
            [['vat', 'discount'], 'number'],
            [['document_id'], 'string', 'max' => 32],
            [['coupon_id', 'created_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'from_id' => 'Từ kho',
            'to_id' => 'Đến kho',
            'input_type' => 'Loại nhập kho',
            'suplly_id' => 'Nhà cung cấp',
            'coupon_id' => 'Phiếu mua hàng',
            'document_id' => 'Số chứng từ',
            'invoice_number' => 'Số hóa đơn',
            'date' => 'Ngày chứng từ',
            'note' => 'Diễn giải',
            'created_name' => 'Người tạo phiếu',
            'vat' => 'Thuế VAT',
            'discount' => 'Chiết khấu/Khuyến mãi',
            'total_price' => 'Tổng tiền',
            'status' => 'Status',
            'created_by' => 'Người lập phiếu',
            'created_at' => 'Ngày lập phiếu',
            'updated_at' => 'Ngày sửa phiếu',
            'updated_by' => 'Người sửa phiếu',
        ];
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
    public function getInputType()
    {
        return $this->hasOne(BillType::className(), ['id' => 'input_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupply()
    {
        return $this->hasOne(Supply::className(), ['id' => 'suplly_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrom()
    {
        return $this->hasOne(RepositoryReport::className(), ['id' => 'from_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTo()
    {
        return $this->hasOne(RepositoryReport::className(), ['id' => 'to_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(BillDetail::className(), ['bill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails3()
    {
        return $this->hasMany(BillDetail::className(), ['bill_id' => 'id'])
            ->where('detail_id IS NULL');
    }

    public function getTotal()
    {
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
