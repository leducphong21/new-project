<?php

namespace common\models\gara\repair;

use common\models\gara\Car;
use common\models\gara\Customer;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_repair_command".
 *
 * @property integer $id
 * @property string $document_id
 * @property string $date
 * @property integer $invoice_id
 * @property integer $technician_id
 * @property integer $car_id
 * @property integer $customer_id
 * @property integer $contacter_id
 * @property integer $repair_by
 * @property integer $pay_type
 * @property integer $repaire_type
 * @property string $note
 * @property string $has_product
 * @property double $vat
 * @property double $discount
 * @property double $total_price
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class RepairCommand extends \yii\db\ActiveRecord
{
    public $has_product;
    public $contacter_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_repair_command';
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
            [['document_id', 'technician_id', 'car_id', 'technician_id'], 'required'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['invoice_id', 'technician_id', 'customer_id', 'contacter_id', 'repair_by', 'pay_type', 'repaire_type', 'status', 'created_by', 'updated_by'], 'integer'],
            [['note'], 'string'],
            [['vat', 'discount', 'total_price'], 'number'],
            [['document_id', 'repair_by_name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'document_id' => 'Số chứng từ',
            'date' => 'Ngày chứng từ',
            'invoice_id' => 'Phiếu báo giá',
            'technician_id' => 'Kỹ thuật viên',
            'car_id' => 'Xe',
            'customer_id' => 'Khách hàng',
            'contacter_id' => 'Người liên hệ',
            'repair_by' => 'Người lập lện sửa chữa',
            'pay_type' => 'Thanh toán',
            'repaire_type' => 'Loại sửa chữa',
            'note' => 'Diễn giải',
            'vat' => 'Thuế VAT',
            'discount' => 'Chiết khấu/Khuyến mãi',
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
    public function getTechnician()
    {
        return $this->hasOne(User::className(), ['id' => 'technician_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairBy()
    {
        return $this->hasOne(User::className(), ['id' => 'repair_by']);
    }

    public function getInvoice()
    {
        return $this->hasOne(Invoice::className(), ['id' => 'invoice_id']);
    }

    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(RepairCommandDetail::className(), ['repair_command_id' => 'id']);
    }

    /**
     * Select First Contacter
     * @return \yii\db\ActiveQuery
     */
    public function getContacter()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_repair_command_customer', ['repair_command_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 3]);
                });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacters()
    {
        return $this->hasMany(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_repair_command_customer', ['repair_command_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 3]);
                });
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
