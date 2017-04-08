<?php

namespace common\models\other;

use Yii;

/**
 * This is the model class for table "other_bill_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 */
class BillType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'other_bill_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
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
            'name' => 'Tên loại',
        ];
    }
}
