<?php
/**
 * Created by PhpStorm.
 * User: lindafei@wn518.com
 * Date: 2016/2/18
 * Time: 17:41
 */
namespace App\Utils;

class ConstantUtil{

    const PROJECT_INDEX = "Index";
    const PROJECT_ADMIN = "Admin";

    const PAGE = 10;


    const SAFE_RANK = 1;                // 文章栏目管理安全等级

    const SYSTEM_INDEX = 1;             // 系统前台
    const SYSTEM_ADMIN = 2;             // 系统后台
    const GLOBAL_TRUE = 1;              // 全局开启
    const GLOBAL_FALSE = 0;             // 全局关闭

    const POWER_SUPER_MANAGE    = 1 ;      // 超级管理员
    const POWER_MANAGE          = 2 ;      // 管理员
    const POWER_SUPER_USER      = 3 ;      // 高级会员
    const POWER_USER            = 4 ;      // 普通会员


    const ARTICLE_USER = 'guanxu';

    public static function poserList($rank="") {
        $result = [
            self::POWER_SUPER_MANAGE    => "超级管理员" ,
            self::POWER_MANAGE          => "管理员" ,
            self::POWER_SUPER_USER      => "高级会员" ,
            self::POWER_USER            => "普通会员" ,
        ];
        if(!empty($rank)) $result = $result[$rank];
        return $result;
    }



    public static function changeStatus($status){
        switch($status) {
            case self::GLOBAL_FALSE :
                return self::GLOBAL_TRUE;
                break;
            case self::GLOBAL_TRUE :
                return self::GLOBAL_FALSE;
                break;
        }

    }
}