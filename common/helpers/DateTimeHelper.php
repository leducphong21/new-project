<?php

namespace common\helpers;


use yii\helpers\Inflector;

/**
 * Collection of useful helper functions for Yii Applications
 *
 * @author dungphanxuan <dungphanxuan999@gmail.vn>
 * @since 1.0
 *
 */
class DateTimeHelper extends Inflector
{

    /*Get File name without extendsion*/
    public static function getMysqlDate($date){

    }
    public static function getRandomNumber($total = 11)
    {
        $str = '';
        for ($i = 0; $i < $total; $i++) {
            $str .= rand(0, 9);
        }
        return $str;
    }


}