<?php

namespace common\helpers\project;


use common\models\project\County;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;


/**
 * Collection of useful helper functions for Yii Applications
 *
 * @author dungphanxuan <dungphanxuan999@gmail.vn>
 * @since 1.0
 *
 */
class CityHelper extends Inflector
{
    public static function getCounty($city_id)
    {
        $dataModel = County::find()
            ->where(['city_id' => $city_id])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }


}