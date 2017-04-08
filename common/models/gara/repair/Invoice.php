<?php

namespace common\models\gara\repair;

use common\models\gara\Car;
use common\models\gara\Customer;
use common\models\gara\repair\query\InvoiceQuery;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use NumberFormatter;
/**
 * This is the model class for table "m_invoice".
 *
 * @property integer $id
 * @property integer $type
 * @property integer $ticket_id
 * @property integer $car_id
 * @property integer $customer_id
 * @property integer $contacter_id
 * @property string $date_in
 * @property double $km_in
 * @property double $total_price
 * @property double $vat
 * @property double $discount
 * @property string $contacter_name
 * @property string $car_number
 * @property string $car_machine
 * @property string $documement_id
 * @property string $has_product
 * @property integer $repaire_type
 * @property string $date
 * @property integer $confirm_type
 * @property string $note
 * @property integer $has_apply
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Invoice extends \yii\db\ActiveRecord
{
    public $has_product;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_invoice';
    }

    /**
     * @return InvoiceQuery
     */
    public static function find()
    {
        return new InvoiceQuery(get_called_class());
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
            [['customer_id', 'car_id', 'km_in', 'documement_id', 'has_product'], 'required'],
            ['km_in', 'required' , 'message' => 'Vui lòng nhập số KM vào'],
            [['type', 'ticket_id', 'car_id', 'customer_id', 'contacter_id', 'repaire_type', 'confirm_type', 'has_apply', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date_in', 'date', 'created_at', 'updated_at'], 'safe'],
            [['km_in', 'discount', 'vat', 'total_price'], 'number'],
            [['note'], 'string'],
            [['documement_id'], 'unique'],
            [['car_number', 'car_machine'], 'string', 'max' => 64],
            [['documement_id'], 'string', 'max' => 32],
            //[['contacter_name'], 'string', 'max' => 255],
            [
                'km_in', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number',
                'message' => 'Số KM vào xưởng phải lớn hơn 0'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Loại',
            'ticket_id' => 'Phiếu tiếp nhận',
            'car_id' => 'Thông tin xe',
            'customer_id' => 'Thông tin khách hàng',
            'contacter_id' => 'Mã người liên hệ',
            'contacter_name' => 'Người liên hệ',
            'date_in' => 'Ngày vào',
            'km_in' => 'Số KM vào',
            'car_number' => 'Số khung',
            'car_machine' => 'Số máy',
            'documement_id' => 'Mã chứng từ',
            'repaire_type' => 'Loại sửa chữa',
            'date' => 'Ngày báo giá',
            'confirm_type' => 'Trạng thái duyệt',
            'note' => 'Diễn giải',
            'discount' => 'Chiết khấu/Khuyến mãi',
            'total_price' => 'Tổng tiền phải thanh toán',
            'vat' => 'Thuế VAT',
            'status' => 'Trạng thái duyệt',
            'has_product' => 'Chi tiết hàng hóa',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa',
        ];
    }

    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
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
        return $this->hasMany(InvoiceDetail::className(), ['invoice_id' => 'id']);
    }

    /**
     * Select First Contacter
     * @return \yii\db\ActiveQuery
     */
    public function getContacter()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_invoice_customer', ['invoice_id' => 'id'],
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
            ->viaTable('d_invoice_customer', ['invoice_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 3]);
                });
    }

    public function getTotalPrice($formatValue = false)
    {
        $dataDetails = $this->details;
        $total = 0;
        foreach ($dataDetails as $item) {
            $total = $total + $item->totalPrice;
        }
        if ($formatValue) {
            $format = Yii::$app->getFormatter();
            $format->thousandSeparator = '.';
            return $format->asDecimal($total);
        }
        return $total;
    }

    public function setApplyCommand($command_id)
    {
        $modelData = new RepairCommandInvoice();
        $modelData->repair_command_id = $command_id;
        $modelData->invoice_id = $this->id;
        $modelData->apply_status = 1;
        if ($modelData->validate()) {
            $modelData->save();
        } else {
            \Yii::warning('Start Log: Model InvoiceTicket not saved', 'ticket_invoice');
            //dd($modelData->getErrors());
        }
    }
    public function getApplyCommand()
    {
        $modelData = RepairCommandInvoice::find()->where(['invoice_id' => $this->id])->one();
        if ($modelData) {
            return true;
        }
        return false;
    }
}
