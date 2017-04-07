<?php
/**
 * Created by PhpStorm.
 * User: sirja
 * Date: 24/03/2017
 * Time: 9:23 CH
 */

namespace common\models\accounting;


use yii\db\ActiveRecord;
use Yii;

class GarageModel extends ActiveRecord
{
    public static function getDb()
    {
        return Yii::$app->db;
    }

}