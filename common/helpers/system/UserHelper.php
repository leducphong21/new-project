<?php

namespace common\helpers\system;


use yii\helpers\Inflector;

/**
 * Collection of useful helper functions for Yii Applications
 *
 * @author dungphanxuan <dungphanxuan999@gmail.vn>
 * @since 1.0
 *
 */
class UserHelper extends Inflector
{

    /*Get File name without extendsion*/
    public static function getAllRole()
    {
        $dataRole = [
            'administrator' => 'Quản trị viên',
            'sales' => 'Kinh doanh',
        ];
        return $dataRole;
    }


}