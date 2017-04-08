<?php

namespace common\models\gara;

use common\models\gara\query\ServiceQuery;
use common\models\User;
use trntv\filekit\behaviors\UploadBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "m_service".
 *
 * @property integer $id
 * @property string $name
 * @property string $unit
 * @property integer $supply_id
 * @property integer $time_type
 * @property integer $time_type_gua
 * @property double $price
 * @property double $price_out
 * @property string $made_in
 * @property string $guarantee
 * @property string $time_guarantee
 * @property string $time_start
 * @property string $note
 * @property string $image_path
 * @property string $image_base_url
 * @property integer $status
 * @property integer $created_by
 * @property string $created_at
 * @property string $updated_at
 * @property integer $updated_by
 */
class Service extends \yii\db\ActiveRecord
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
        return 'm_service';
    }

    /**
     * @return ServiceQuery
     */
    public static function find()
    {
        return new ServiceQuery(get_called_class());
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
            [['name'], 'required'],
            [['supply_id', 'category_id', 'manufacturer_id', 'status', 'time_type', 'time_type_gua', 'created_by', 'updated_by'], 'integer'],
            [['price'], 'number'],
            [['note'], 'string'],
            [['created_at', 'updated_at' , 'time_guarantee', 'time_start'], 'safe'],
            [['name', 'unit', 'made_in', 'guarantee'], 'string', 'max' => 255],
            [['image_path', 'image_base_url'], 'string', 'max' => 1024],
            [['price'], 'compare', 'compareValue' => 0, 'operator' => '>=', 'type' => 'number', 'message' => 'Giá thành phải lớn hơn 0'],
            [['image'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Mã dịch vụ',
            'name' => 'Tên dịch vụ',
            'unit' => 'Đơn vị tính',
            'supply_id' => 'Nhà cung cấp',
            'price' => 'Giá thành',
            'made_in' => 'Xuất xứ',
            'guarantee' => 'Bảo hành',
            'time_guarantee' => 'Thời gian bảo hành',
            'time_start' => 'Thời gian thực hiện',
            'note' => 'Ghi chú',
            'image_path' => 'Image Path',
            'image_base_url' => 'Image Base Url',
            'status' => 'Status',
            'image' => 'Hình ảnh',
            'time_type' => 'Thời gian bảo hành',
            'time_type_gua' => 'Thời gian bảo hành',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày sửa',
            'updated_by' => 'Người sửa',
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
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManufacturer()
    {
        return $this->hasOne(ProductManufacturer::className(), ['id' => 'manufacturer_id']);
    }

}
