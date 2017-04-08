<?php

namespace common\models\gara;

use common\models\gara\query\ProductManufacturerQuery;
use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_repository_report".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $status
 * @property string $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class ProductManufacturer extends \yii\db\ActiveRecord
{
    public $product;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_product_manufacturer';
    }

    /**
     * @return ProductManufacturerQuery
     */
    public static function find()
    {
        return new ProductManufacturerQuery(get_called_class());
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
            [['name'], 'required'],
            ['name', 'unique'],
            [['status', 'updated_by'], 'integer'],
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
            'id' => 'Mã hãng',
            'name' => 'Tên hãng',
            'status' => 'Tình trạng',
            'product' => 'Số lượng xe',
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

    public function getCarCount()
    {
        // CarCarry has_many Car via Car.car_model_id -> id
        return $this->hasMany(Product::className(), [ 'product_id' => 'id'])->count();
    }

}
