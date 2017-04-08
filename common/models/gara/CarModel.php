<?php

namespace common\models\gara;

use common\models\gara\query\CarModelQuery;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_repository_report".
 *
 * @property integer $id
 * @property integer $car_carry_id
 * @property string $code
 * @property string $name
 * @property integer $status
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class CarModel extends \yii\db\ActiveRecord
{
    public $product;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_car_model';
    }

    /**
     * @return CarModelQuery
     */
    public static function find()
    {
        return new CarModelQuery(get_called_class());
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
            [['car_carry_id'], 'required'],
            ['name', 'required', 'message' => 'Tên loại xe không được để trống.'],
            //['name', 'unique', 'targetAttribute' => ['name', 'car_carry_id'], 'message' => 'Tên loại xe đã được sử dụng!'],
            ['name', 'unique', 'message' => 'Tên loại xe đã được sử dụng!'],
            [['status', 'updated_by', 'car_carry_id'], 'integer'],
            [['created_by', 'created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_carry_id' => 'Hãng xe',
            'code' => 'Mã loại',
            'name' => 'Tên loại',
            'product' => 'Xe',
            'status' => 'Tình trạng',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa'
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
    public function getCarry()
    {
        return $this->hasOne(CarCarry::className(), ['id' => 'car_carry_id']);
    }

    public function getCarCount()
    {
        // CarModel has_many Car via Car.car_model_id -> id
        return $this->hasMany(Car::className(), ['car_model_id' => 'id'])->count();
    }
}
