<?php
class TimeUtil
{
    public static function getLastTime($datetime){
        $t = strtotime($datetime);
        $now = time();
        if($now-$t<60){
            $intv = (($now-$t)>10?($now-$t):10).'秒';
        } elseif($now-$t<3600){
            $intv = floor(($now-$t)/60).'分钟';
        } elseif($now-$t<86400){
            $intv = floor(($now-$t)/3600).'小时';
        } elseif($now-$t<86400 * 30){
            $intv = floor(($now-$t)/86400).'天';
        } else {
            $intv = '一个月';
        }
        return $intv.'前';
    }
}
