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
class SystemHelper extends Inflector
{
    /*
     * Kiểm tra phiên bản Mysql trên server
     * */
    public static function isMysql57(){
        $output = shell_exec('mysql -V');
        preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version);
        if($version){
            if (strpos($version[0], '5.7') !== false) {
                return true;
            }
        }
        return false;
    }


}