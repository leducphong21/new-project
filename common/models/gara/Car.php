<?php

namespace common\models\gara;

use common\models\gara\query\CarQuery;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_car".
 *
 * @property integer $id
 * @property integer $car_carry_id
 * @property integer $car_model_id
 * @property string $no
 * @property string $number
 * @property string $machine
 * @property string $gear_box
 * @property string $code_furniture
 * @property string $color
 * @property string $model
 * @property string $capacity
 * @property string $register_no
 * @property string $register_date
 * @property string $register_address
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Car extends \yii\db\ActiveRecord
{
    public $carry_id;
    public $owner_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_car';
    }


    /**
     * @return CarQuery
     */
    public static function find()
    {
        return new CarQuery(get_called_class());
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
            [['car_carry_id', 'car_model_id', 'no', 'owner_name'], 'required'],
            ['no', 'unique', 'message' => 'Biển số xe đã có trong hệ thống'],
            ['no', 'match', 'pattern' => '/^[a-zA-Z0-9 ._-]+$/', 'message' => 'Biển số xe không hợp lệ.'],
            [['car_carry_id', 'car_model_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['register_date', 'created_at', 'updated_at'], 'safe'],
            [['no'], 'string', 'max' => 16],
            [['no'], 'string', 'min' => 7],
            [['number'], 'string', 'max' => 63],
            [['machine', 'gear_box', 'code_furniture'], 'string', 'max' => 64],
            [['color', 'model', 'capacity', 'register_no'], 'string', 'max' => 32],
            [['register_address'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            $this->no = strtoupper($this->no);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_carry_id' => 'Hãng xe',
            'car_model_id' => 'Loại xe',
            'no' => 'Biển số',
            'owner_name' => 'Thông tin chủ xe',
            'number' => 'Số khung',
            'machine' => 'Số máy',
            'gear_box' => 'Hộp số',
            'code_furniture' => 'Mã nội thất',
            'color' => 'Màu xe',
            'model' => 'Model xe',
            'capacity' => 'Dung tích',
            'register_no' => 'Số đăng ký',
            'register_date' => 'Ngày đăng ký',
            'register_address' => 'Nơi đăng ký',
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
    public function getCarCarry()
    {
        return $this->hasOne(CarCarry::className(), ['id' => 'car_carry_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarModel()
    {
        return $this->hasOne(CarModel::className(), ['id' => 'car_model_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id'])
            ->viaTable('d_car_customer', ['car_id' => 'id'],
                function ($query) {
                    $query->onCondition(['type' => 1]);
                });
    }

}
