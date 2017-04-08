<?php

namespace common\models\other;

use Yii;

/**
 * This is the model class for table "other_unit".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other_unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name','code'], 'required'],
            [['code'], 'string', 'max' => 8],
            [['name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'STT',
            'code' => 'Mã đơn vi tính',
            'name' => 'Tên đơn vị tính',
        ];
    }
}
