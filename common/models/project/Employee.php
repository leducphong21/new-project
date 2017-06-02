<?php

namespace common\models\project;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\project\Branch;
use common\models\project\Department;

/**
 * This is the model class for table "m_employee".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $branch_id
 * @property integer $department_id
 * @property string $phone_number
 * @property string $address
 * @property integer $deleted
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_employee';
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
            [['branch_id', 'department_id', 'deleted','regency_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 8],
            [['phone_number'], 'string', 'max' => 16],
            ['name','required','message' => 'Tên không được để trống'],
            ['address','required','message' => 'Địa chỉ không được để trống'],
            ['phone_number','required','message' => 'Số điện thoại không được để trống'],
            ['regency_id','required','message' => 'Chức vụ không được để trống'],
            ['department_id','required','message' => 'Bộ phận không được để trống'],
            ['branch_id','required','message' => 'Chi nhánh không được để trống'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên nhân viên',
            'code' => 'Mã',
            'regency_id' => 'Chức vụ',
            'branch_id' => 'Chi nhánh',
            'department_id' => 'Bộ phận',
            'phone_number' => 'Điện thoại',
            'address' => 'Địa chỉ',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_by' => 'Người sửa',
            'updated_at' => 'Ngày sửa',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\project\query\EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\project\query\EmployeeQuery(get_called_class());
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getBranch()
    {
        return $this->hasOne(Branch::className(), ['id' => 'branch_id']);
    }
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
    public function getRegency()
    {
        return $this->hasOne(Regency::className(), ['id' => 'regency_id']);
    }
}
