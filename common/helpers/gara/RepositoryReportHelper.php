<?php
namespace common\helpers\gara;

use common\helpers\DataHelper;
use common\models\gara\RepositoryReport;
use Yii;
use yii\helpers\Inflector;

class RepositoryReportHelper extends Inflector
{

    /*
     * Random Article ID
     * */
    public static function getRandomID()
    {
        $code = DataHelper::getRandomNumber();
        $model = (new \yii\db\Query())
            ->from('m_repository_report')
            ->where('code='. $code)
            ->one();
        if (!$model) {
            return $code;
        }
        return RepositoryReportHelper::getRandomID();
    }

}