<?php

namespace common\models\project;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_product".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $product_category_id
 * @property integer $type
 * @property integer $project_id
 * @property integer $county_id
 * @property integer $city_id
 * @property integer $price
 * @property integer $acreage
 * @property integer $total_price
 * @property integer $interest
 * @property integer $status_description
 * @property integer $status
 * @property integer $deleted
 * @property string $name_seller
 * @property string $address_seller
 * @property string $mobile_seller
 * @property string $email_seller
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property string $address
 * @property integer $floors
 * @property integer $rooms
 * @property integer $bedrooms
 * @property integer $bathrooms
 * @property string $description
 * @property integer $land_id
 * @property integer $portion_id
 */
class Product extends \yii\db\ActiveRecord
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
            [['product_category_id', 'type', 'project_id', 'county_id', 'city_id', 'price', 'acreage', 'total_price', 'interest', 'status_description', 'status', 'deleted', 'created_by', 'updated_by', 'floors', 'rooms', 'bedrooms', 'bathrooms', 'land_id', 'portion_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['name', 'name_seller', 'address_seller', 'email_seller', 'address'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 8],
            [['mobile_seller'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'product_category_id' => 'Product Category ID',
            'type' => 'Type',
            'project_id' => 'Project ID',
            'county_id' => 'County ID',
            'city_id' => 'City ID',
            'price' => 'Price',
            'acreage' => 'Acreage',
            'total_price' => 'Total Price',
            'interest' => 'Interest',
            'status_description' => 'Status Description',
            'status' => 'Status',
            'deleted' => 'Deleted',
            'name_seller' => 'Name Seller',
            'address_seller' => 'Address Seller',
            'mobile_seller' => 'Mobile Seller',
            'email_seller' => 'Email Seller',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'address' => 'Address',
            'floors' => 'Floors',
            'rooms' => 'Rooms',
            'bedrooms' => 'Bedrooms',
            'bathrooms' => 'Bathrooms',
            'description' => 'Description',
            'land_id' => 'Land ID',
            'portion_id' => 'Portion ID',
        ];
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
