<?php

namespace common\helpers\project;

use common\models\project\ModelProject;
use common\models\project\Land;
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
    public static function getProject($county_id)
    {
        $dataModel = ModelProject::find()
            ->where(['county_id' => $county_id])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }

    public static function getPortion($project_id)
    {
        $dataModel = Portion::find()
            ->where(['project_id' => $project_id])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }

    public static function getLand($portion_id)
    {
        $dataModel = Land::find()
            ->where(['portion_id' => $portion_id])
            ->orderBy('id DESC')
            ->asArray()->all();
        $data = ArrayHelper::map($dataModel, 'id', 'name');
        return $data;
    }


}