<?php

namespace common\models\project;

use common\models\User;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use common\models\project\ModelProject;
use common\models\project\Portion;

/**
 * This is the model class for table "m_land".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $project_id
 * @property integer $deleted
 * @property integer $portion_id
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Land extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'm_land';
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
            [['project_id', 'deleted', 'portion_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at','acreage','location'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 8],
            ['name','required','message' => 'Tên thửa đất không được để trống'],
            ['project_id','required','message' => 'Dự án không được để trống'],
            ['portion_id','required','message' => 'Lô đất không được để trống'],
            ['acreage','required','message' => 'Diện tích không được để trống'],
            ['location','required','message' => 'Vị trí không được để trống'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên thửa đất',
            'code' => 'Code',
            'project_id' => 'Dự án',
            'acreage'=> 'Diện tích',
            'location'=> 'Vị trí',
            'deleted' => 'Deleted',
            'portion_id' => 'Lô đất',
            'created_by' => 'Người tạo',
            'created_at' => 'Ngày tạo',
            'updated_by' => 'Người sửa',
            'updated_at' => 'Ngày sửa',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\project\query\LandQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\project\query\LandQuery(get_called_class());
    }
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getProject()
    {
        return $this->hasOne(ModelProject::className(), ['id' => 'project_id']);
    }

    public function getPortion()
    {
        return $this->hasOne(Portion::className(), ['id' => 'portion_id']);
    }
}
