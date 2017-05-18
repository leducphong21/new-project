<?php

namespace common\helpers\project;


use common\models\project\Product;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;


/**
 * Collection of useful helper functions for Yii Applications
 *
 * @author dungphanxuan <dungphanxuan999@gmail.vn>
 * @since 1.0
 *
 */
class ProductHelper extends Inflector
{
    public static function getProduct($type)
    {
        $dataModel = Product::find()
            ->where(['type' => $type])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }


}