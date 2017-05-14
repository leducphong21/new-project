<?php

namespace common\helpers\project;


use common\models\project\Portion;
use yii\helpers\Inflector;
use yii\helpers\ArrayHelper;


/**
 * Collection of useful helper functions for Yii Applications
 *
 * @author dungphanxuan <dungphanxuan999@gmail.vn>
 * @since 1.0
 *
 */
class ProjectHelper extends Inflector
{
    public static function getPortion($project_id)
    {
        $dataModel = Portion::find()
            ->where(['project_id' => $project_id])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }


}