<?php

namespace common\models\other;

use Yii;

/**
 * This is the model class for table "other_country".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $population
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'popular'], 'required'],
            [['population'], 'integer'],
            [['name'], 'string', 'max' => 52],
            [['code'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'STT',
            'name' => 'Tên quốc gia',
            'code' => 'Mã quốc gia',
            'population' => 'Dân số',
        ];
    }
}
