<?php

namespace common\models\gara;

use common\models\gara\data\CarCustomer;
use common\models\gara\query\CustomerQuery;
use common\models\User;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_customer".
 *
 * @property integer $id
 * @property integer $cid
 * @property integer $customer_category_id
 * @property integer $type
 * @property string $name
 * @property string $mobile
 * @property string $email
 * @property string $address
 * @property string $address1
 * @property string $address2
 * @property string $resource
 * @property integer $number
 * @property string $identity_card
 * @property string $position
 * @property integer $gender
 * @property string $customer_tax
 * @property string $birthday
 * @property string $fax_number
 * @property string $company_name
 * @property string $company_address
 * @property string $company_email
 * @property string $company_tax
 * @property string $website
 * @property string $bank_name
 * @property string $bank_no
 * @property string $bank_address
 * @property string $other
 * @property string $avatar_path
 * @property string $avatar_base_url
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Customer extends \yii\db\ActiveRecord
{
    const TYPE_CUSTOMER = 1;
    const TYPE_CUSTOMER_CONTACTER = 2;
    const TYPE_CUSTOMER_CAROWNER = 3;


    public $number_repair;
    /**
     * @var array
     */
    public $avatar;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_customer';
    }

    /**
     * @return CustomerQuery
     */
    public static function find()
    {
        return new CustomerQuery(get_called_class());
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
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'avatar',
                'pathAttribute' => 'avatar_path',
                'baseUrlAttribute' => 'avatar_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['name', 'mobile', 'address'], 'required'],
            [['name',], 'required', 'message' => 'Vui lòng nhập họ tên'],
            [['mobile'], 'required', 'message' => 'Vui lòng nhập số điện thoại'],
            [['address'], 'required', 'message' => 'Vui lòng nhập địa chỉ'],
            [['customer_category_id', 'cid', 'type', 'number', 'status', 'gender', 'created_by', 'updated_by'], 'integer'],
            [['birthday', 'created_at', 'updated_at'], 'safe'],
            [['other'], 'string'],
            ['status', 'default', 'value' => 1],
            [['name'], 'string', 'max' => 255],
            [['name'], 'string', 'min' => 5, 'message' => 'Tên ít nhất 5 ký tự'],
            [['mobile'], 'string', 'min' => 10, 'message' => 'Số điện thoại phải chứa ít nhất 10 số.'],
            [['fax_number'], 'string', 'max' => 9],
            [['customer_tax'], 'string', 'max' => 16],
            [['email', 'address', 'address1', 'address2', 'resource', 'company_name', 'company_address', 'company_email', 'company_tax', 'website', 'bank_name', 'bank_no', 'bank_address', 'position'], 'string', 'max' => 255],
            [['avatar_path', 'avatar_base_url'], 'string', 'max' => 1024],
            [['email', 'company_email'], 'email'],
            //['identity_card', 'unique', 'message' => 'CMND đã tồn tại'],
            [['identity_card'], 'string', 'max' => 12, 'message' => 'CMND không được quá 12 số.'],
            [['identity_card'], 'string', 'min' => 9, 'message' => 'CMND có ít nhất 12 số.'],
            [['identity_card'], 'unique', 'message' => 'Thông tin CMND đã tồn tại'],
            [['mobile'], 'integer', 'message' => 'Số điện thoại không hợp lệ.'],
            //[['mobile'], 'string', 'min' => 10],
            [['avatar'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Khách hàng',
            'customer_category_id' => 'Nhóm khách hàng',
            'type' => 'Các kiểu khách hàng',
            'name' => 'Tên',
            'mobile' => 'Số điện thoại',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'address1' => 'Địa chỉ 1',
            'address2' => 'Địa chỉ 2',
            'resource' => 'Nguồn khách',
            'number' => 'Số lần sửa chữa',
            'identity_card' => 'CMND',
            'position' => 'Chức vụ',
            'gender' => 'Giới tính',
            'birthday' => 'Ngày sinh',
            'fax_number' => 'Số Fax',
            'customer_tax' => 'Mã số thuế cá nhân',
            'company_name' => 'Tên công ty',
            'company_address' => 'Địa chỉ công ty',
            'company_email' => 'Email công ty',
            'company_tax' => 'Mã số thuế công ty',
            'website' => 'Địa chỉ trang web',
            'bank_name' => 'Tên ngân hàng',
            'bank_no' => 'Số tài khoản ngân hàng',
            'bank_address' => 'Địa chỉ ngân hàng',
            'other' => 'Thông tin khác',
            'avatar' => 'Ảnh đại diện',
            'avatar_path' => 'Ảnh đại diện',
            'avatar_base_url' => 'Đường dẫn ảnh',
            'number_repair' => 'Số lần sửa chữa',
            'status' => 'Tình trạng',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CustomerCategory::className(), ['id' => 'customer_category_id']);
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

    public function getCarCustomer()
    {
        return $this->hasMany(CarCustomer::className(), ['customer_id' => 'id']);
    }
}
