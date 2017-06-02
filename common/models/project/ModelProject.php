<?php

namespace common\models\project;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\project\County;
use common\models\project\City;
use common\models\project\ProjectCategory;

/**
 * This is the model class for table "m_project".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $project_category_id
 * @property integer $areage
 * @property integer $number_product
 * @property integer $county_id
 * @property integer $city
 * @property integer $deleted
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class ModelProject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_project';
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
            [['project_category_id', 'acreage', 'number_product', 'county_id', 'city_id', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['address','created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 8],
            ['name','required','message' => 'Tên dự án không được để trống'],
            ['project_category_id','required','message' => 'Loại dự án không được để trống'],
            ['address','required','message' => 'Không được để trống không được để trống'],
            ['city_id','required','message' => 'Tỉnh thành không được để trống'],
            ['county_id','required','message' => 'Quận huyện không được để trống'],
        ];
    }

    /**
     * @inheritdocaa
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên dự án',
            'code' => 'Mã',
            'project_category_id' => 'Loại dự án',
            'address' => 'Địa chỉ',
            'acreage' => 'Diện tích',
            'number_product' => 'Số sản phẩm',
            'county_id' => 'Quận/Huyện',
            'city_id' => 'TỈnh/Thành',
            'deleted' => 'Deleted',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_by' => 'Người sửa',
            'updated_at' => 'Ngày sửa',
        ];
    }

    /**
     * @inheritdoc
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getCounty()
    {
        return $this->hasOne(County::className(), ['id' => 'county_id']);
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    public function getProjectCategory()
    {
        return $this->hasOne(ProjectCategory::className(), ['id' => 'project_category_id']);
    }
}
