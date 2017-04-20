<?php

namespace common\models\project;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_category_id', 'areage', 'number_product', 'county_id', 'city', 'deleted', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 8],
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
            'project_category_id' => 'Project Category ID',
            'areage' => 'Areage',
            'number_product' => 'Number Product',
            'county_id' => 'County ID',
            'city' => 'City',
            'deleted' => 'Deleted',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
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
}
