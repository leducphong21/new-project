<?php

namespace common\models\project;

use backend\assets_b\Project;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\project\City;
use common\models\project\County;
use common\models\project\ProductCategory;
use common\models\project\ModelProject;

/**
 * This is the model class for table "m_product".
 *
 * @property integer $id
 * @property string $code
 * @property integer $product
 * @property integer $project_id
 * @property integer $county_id
 * @property integer $city_id
 * @property integer $price
 * @property integer $acreage
 * @property integer $total_price
 * @property integer $status_description
 * @property integer $status
 * @property integer $deleted
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class ProductRent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_product';
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
            [['type','floors','bedrooms','rooms','bathrooms','product_category_id', 'project_id', 'county_id', 'city_id', 'acreage', 'total_price', 'status_description', 'status', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','address','description'], 'safe'],
            [['code'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 64],
            [['type','product_category_id','county_id','city_id','acreage','name'],'required' ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên sản phẩm',
            'code' => 'Mã',
            'product_category_id' => 'Loại sản phẩm',
            'project_id' => 'Dự án',
            'type' => 'Bán/Thuê',
            'county_id' => 'Quận huyện',
            'city_id' => 'Tỉnh thành',
            'address' => 'Địa chỉ',
            'acreage' => 'Diện tích',
            'total_price' => 'Giá thuê/tháng',
            'status_description' => 'Mô tả',
            'status' => 'Trạng thái',
            'deleted' => 'Deleted',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'description' => 'Mô tả',
            'rooms' => 'Số phòng',
            'bedrooms' => 'Số phòng ngủ',
            'bathrooms' => 'Số phòng vệ sinh',
            'floors' => 'Số tầng'
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\project\query\ProductRentQuẻy the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\project\query\ProductRentQuery(get_called_class());
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    public function getCounty()
    {
        return $this->hasOne(County::className(), ['id' => 'county_id']);
    }
    public function getProject()
    {
        return $this->hasOne(ModelProject::className(), ['id' => 'project_id']);
    }
    public function getProductCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'product_category_id']);
    }

}
