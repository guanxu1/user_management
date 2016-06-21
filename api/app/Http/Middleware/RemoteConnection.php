<?php

namespace App\Http\Middleware;

use App\Utils\Bat\ConstantUtil;
use Closure;

class RemoteConnection
{
    private static $sock;
    private static $timeout = 2;

    /**
     * 远程连接
     * @param $host
     * @param $port
     * @param $str
     * @return mixed
     */
    public static function link($host,$port,$str) {
        self::$sock = fsockopen($host,$port);
        socket_set_timeout(self::$sock ,self::$timeout);
        fwrite(self::$sock,$str."\r\n");
        $result = self::fileAnalysis();
        return $result;
    }

    /**
     * 远程返回文件解析
     * @return mixed
     */
    private static function fileAnalysis() {
        $result = "";
        while(1) {
            $return  = fgets(self::$sock);
            if(strstr($return,"-EOF-")) return  self::surplusStrClean($result);
            $result.=$return;
        }
    }

    /**
     * 特殊字符清除
     * @param $str
     * @return mixed
     */
    private static function surplusStrClean($str){
        $str = str_replace("\n","",$str) ;
        $str = str_replace("\r","",$str) ;
        return $str;
    }


}
