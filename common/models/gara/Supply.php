<?php

namespace common\models\gara;

use common\models\gara\query\SupplyQuery;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_supply".
 *
 * @property integer $id
 * @property integer $cid
 * @property string $name
 * @property string $mobile
 * @property string $tax_code
 * @property string $address
 * @property string $website
 * @property string $email
 * @property string $resource
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Supply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_supply';
    }

    /**
     * @return SupplyQuery
     */
    public static function find()
    {
        return new SupplyQuery(get_called_class());
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
            [['cid', 'status', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'tax_code', 'address', 'website', 'email'], 'string', 'max' => 255],
            [['resource'], 'string', 'max' => 64],
            [['mobile'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã',
            'cid' => 'Nhóm',
            'name' => 'Tên nhà cung cấp',
            'mobile' => 'Điện thoại',
            'tax_code' => 'Mã số thuế',
            'address' => 'Địa chỉ',
            'website' => 'Website',
            'email' => 'Email',
            'resource' => 'Nguồn khách',
            'status' => 'Status',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(CustomerCategory::className(), ['id' => 'cid']);
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
}
