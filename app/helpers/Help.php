<?php 
namespace app\helpers;

class Help{
    public static function getDateTime($input){
        $date = substr($input,0,10);
        $date = explode('/',$date);
        $date = $date[2] .'-'. $date[0] .'-'. $date[1];
        $time = substr($input,11);
        $time = explode(' ',$time);
        $time2 = $time[1];
        $time = $time[0];
        $time = explode(':',$time);
        if($time2=="PM"){
            $time[0] = strval(((int)$time[0])+12);
        }
        $time = $time[0].':'.$time[1].':00';
        return $date.' '.$time;
    }

    public static function generateOrderCode(){
        $code = strval(microtime(true));
        $code = explode('.',$code);
        $code[0] = strval(dechex ((int)$code[0]));
        return strtoupper($code[0].'.'.$code[1]);
    }
}