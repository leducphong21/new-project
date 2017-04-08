<?php

namespace common\models\gara\repair;

use common\models\gara\Car;
use common\models\gara\Customer;
use common\models\gara\repair\TicketDetail;
use common\models\gara\repair\query\TicketQuery;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_ticket".
 *
 * @property integer $id
 * @property integer $car_id
 * @property integer $car_owner_id
 * @property integer $customer_id
 * @property integer $customer_contact_id
 * @property integer $repair_type
 * @property integer $checkin_by
 * @property string $checkin_by_name
 * @property double $date_in
 * @property string $date_out
 * @property integer $date_int_type
 * @property double $km_in
 * @property double $km_out
 * @property string $note
 * @property string $has_error
 * @property integer $has_apply
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Ticket extends \yii\db\ActiveRecord
{
    public $has_error;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_ticket';
    }

    /**
     * @return TicketQuery
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
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
            [['car_id', 'car_owner_id', 'customer_id', 'km_in', 'checkin_by_name', 'date_in', 'date_out', 'has_error'], 'required'],
            [['car_id', 'car_owner_id', 'customer_id', 'customer_contact_id', 'repair_type', 'checkin_by', 'date_int_type', 'has_apply', 'status', 'created_by', 'updated_by'], 'integer'],
            [['date_in', 'km_in', 'km_out'], 'number'],
            [['date_out', 'created_at', 'updated_at'], 'safe'],
            [['note'], 'string'],
            [['checkin_by_name'], 'string', 'max' => 255],
            [
                'km_out', 'compare', 'compareAttribute' => 'km_in', 'operator' => '>=', 'type' => 'number',
                'message' => 'Số KM xuất xưởng phải lớn hoặc bằng số KM vào xưởng'
            ],
            [
                'km_in', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number',
                'message' => 'Số KM vào xưởng phải lớn hơn 0'
            ],
            [
                'date_in', 'compare', 'compareValue' => 0, 'operator' => '>', 'type' => 'number',
                'message' => 'Thời gian sửa dự kiến phải lớn hơn 0'
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
            'car_id' => 'Thông tin xe',
            'car_owner_id' => 'Chủ xe',
            'customer_id' => 'Thông tin khách hàng',
            'customer_contact_id' => 'Người liên hệ',
            'repair_type' => 'Loại sửa chữa',
            'checkin_by' => 'Người tiếp nhận',
            'checkin_by_name' => 'Người tiếp nhận',
            'date_in' => 'Thời gian sửa dự kiến',
            'date_out' => 'Ngày dự kiến xuất xưởng',
            'date_int_type' => 'Date Int Type',
            'km_in' => 'Số KM vào xưởng',
            'km_out' => 'Số KM xuất xưởng',
            'note' => 'Ghi chú',
            'has_error' => 'Chi tiết lỗi',
            'status' => 'Status',
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
    public function getCar()
    {
        return $this->hasOne(Car::className(), ['id' => 'car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_ticket_customer', ['ticket_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 1]);
                });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_ticket_customer', ['ticket_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 2]);
                });
    }

    /**
     * Select First Contacter
     * @return \yii\db\ActiveQuery
     */
    public function getContacter()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_ticket_customer', ['ticket_id' => 'id'],
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
            ->viaTable('d_ticket_customer', ['ticket_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 3]);
                });
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetails()
    {
        return $this->hasMany(TicketDetail::className(), ['ticket_id' => 'id']);
    }

    public function setApplyInvoice($invoice_id)
    {
        $modelData = new InvoiceTicket();
        $modelData->invoice_id = $invoice_id;
        $modelData->ticket_id = $this->id;
        $modelData->apply_status = 1;
        if ($modelData->validate()) {
            $modelData->save();
        } else {
            \Yii::warning('Start Log: Model InvoiceTicket not saved', 'ticket_invoice');
            //dd($modelData->getErrors());
        }
    }

    public function getApplyInvoice()
    {
        $modelData = InvoiceTicket::find()->where(['ticket_id' => $this->id])->one();
        if ($modelData) {
            return true;
        }
        return false;
    }
}
