<?php

namespace common\models\gara;

use common\models\gara\query\ProductManufacturerQuery;
use common\models\gara\query\ProductQuery;
use common\models\User;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_product".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property string $unit
 * @property integer $supply_id
 * @property double $price_in
 * @property double $price_out
 * @property string $made_in
 * @property string $guarantee
 * @property string $time_guarantee
 * @property string $time_start
 * @property string $note
 * @property string $image_path
 * @property string $image_base_url
 * @property integer $type
 * @property integer $status
 * @property integer $guarantee_type
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $image;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_product';
    }

    /**
     * @return ProductQuery
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
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
            [
                'class' => UploadBehavior::className(),
                'attribute' => 'image',
                'pathAttribute' => 'image_path',
                'baseUrlAttribute' => 'image_base_url'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['category_id', 'supply_id', 'manufacturer_id', 'type', 'status', 'guarantee_type', 'created_by', 'updated_by'], 'integer'],
            //[['price_in', 'price_out'], 'number'],
            [['price_in', 'price_out'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['note'], 'string'],
            [['created_at', 'updated_at', 'time_guarantee', 'time_start'], 'safe'],
            [['name', 'unit', 'made_in', 'guarantee'], 'string', 'max' => 255],
            [['image_path', 'image_base_url'], 'string', 'max' => 1024],
            [['price_in', 'price_out'], 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number', 'message' => 'Giá thành phải lớn hơn 0'],
            [['image'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã hàng',
            'name' => 'Tên hàng',
            'category_id' => 'Nhóm hàng',
            'unit' => 'Đơn vị tính',
            'supply_id' => 'Nhà cung cấp',
            'manufacturer_id' => 'Hãng sản xuất',
            'price_in' => 'Giá nhập',
            'price_out' => 'Giá bán',
            'made_in' => 'Xuất xứ',
            'guarantee' => 'Bảo hành',
            'guarantee_type' => 'Tháng/Năm',
            'time_guarantee' => 'Thời gian bảo hành',
            'time_start' => 'Thời gian thực hiện',
            'note' => 'Ghi chú',
            'image_path' => 'Image Path',
            'image_base_url' => 'Image Base Url',
            'type' => 'Loại',
            'status' => 'Status',
            'image' => 'Hình ảnh',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            //$this->price_in = str_replace(",", ".", $this->price_in);
           //$this->price_out = str_replace(",", ".", $this->price_out);
            return true;
        } else {
            return false;
        }
    }

    public function getGuaranteeFull()
    {
        if ($this->guarantee) {
            $text = $this->guarantee_type == 1 ? 'Tháng' : 'Năm';
            return $this->guarantee . ' ' . $text;
        }
        return $this->guarantee;
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
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupply()
    {
        return $this->hasOne(Supply::className(), ['id' => 'supply_id']);
    }

    public function getManufacturer()
    {
        return $this->hasone(ProductManufacturer::className(), ['id' => 'manufacturer_id']);
    }
}
