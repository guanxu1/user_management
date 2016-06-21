<?php

namespace App\Events;
use Dotenv;
class Event {

    private static $file = [
        "user"       => [
            "user.ini" ,
        ]
    ];




    public static function file_ini() {

        foreach(self::$file as $key => $val) {
                foreach($val as $val2) {
                    if(file_exists(env("WN_CONFIG_HOME").'/'.$key.'/'.$val2))
                        Dotenv::load(env("WN_CONFIG_HOME").'/'.$key, $val2);
                }
        }
        return true;
    }



}
