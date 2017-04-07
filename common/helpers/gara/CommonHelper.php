<?php

namespace common\helpers\gara;

use Yii;
use yii\helpers\Inflector;

class CommonHelper extends Inflector
{
    public static function getPayType()
    {
        $dataPayType = [
            1 => 'Tiền mặt',
            2 => 'Chuyển khoản'
        ];
        return $dataPayType;
    }
}