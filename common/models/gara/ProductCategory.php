<?php

namespace common\models\gara;

use common\models\gara\query\ProductCategoryQuery;
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
class ProductCategory extends \yii\db\ActiveRecord
{
    public $product;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_product_category';
    }


    /**
     * @return ProductCategoryQuery
     */
    public static function find()
    {
        return new ProductCategoryQuery(get_called_class());
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
            [[ 'name'], 'required'],
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
            'id' => 'ID',
            'code' => 'Mã nhóm hàng',
            'name' => 'Tên nhóm hàng',
            'status' => 'Tình trạng',
            'product' => 'Số hàng hóa',
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
}
