<?php

namespace common\models\accounting\common;

use common\models\User;
use Yii;

/**
 * This is the model class for table "acc_m_employees".
 *
 * @property integer $id
 * @property string $name
 * @property string $department
 * @property double $base_pay
 * @property double $seniority
 * @property string $date_start
 * @property integer $gender
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'acc_m_employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['base_pay', 'seniority'], 'number'],
            [['date_start', 'created_at', 'updated_at'], 'safe'],
            [['gender', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['department'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã nhân viên',
            'name' => 'Tên nhân viên',
            'department' => 'Bộ phận',
            'base_pay' => 'Lương cơ bản',
            'seniority' => 'Thâm niên',
            'date_start' => 'Ngày bắt đầu',
            'gender' => 'Giới tính',
            'status' => 'Status',
            'created_by' => 'Người tạo',
//            'created_at' => 'Created At',
//            'updated_at' => 'Updated At',
//            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\accounting\common\query\EmployeesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\accounting\common\query\EmployeesQuery(get_called_class());
    }

    //get author
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
}
