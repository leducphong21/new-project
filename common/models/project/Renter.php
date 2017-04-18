<?php

namespace common\models\project;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_customer".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $gender
 * @property string $birth_day
 * @property integer $type
 * @property string $address
 * @property string $phone_number
 * @property string $email
 * @property string $job
 * @property string $tax_code
 * @property integer $deleted
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Renter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_customer';
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
            [['gender', 'type', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['birth_day', 'created_at', 'updated_at'], 'safe'],
            [['name', 'address'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 8],
            [['phone_number', 'tax_code'], 'string', 'max' => 16],
            [['email', 'job'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên',
            'code' => 'Mã',
            'gender' => 'Giới tính',
            'birth_day' => 'Ngày sinh',
            'type' => 'Type',
            'address' => 'Địa chỉ',
            'phone_number' => 'Điện thoại',
            'email' => 'Email',
            'job' => 'Nghề nghiệp',
            'tax_code' => 'Mã số thuế',
            'deleted' => 'Deleted',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_by' => 'Người sửa',
            'updated_at' => 'Ngày sửa',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\project\query\RenterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\project\query\RenterQuery(get_called_class());
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
