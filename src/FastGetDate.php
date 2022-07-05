<?php

namespace Zhangerwa\Utils;

class FastGetDate
{
    /**
     * 这个星期的星期一
     * @param int $timestamp 某个星期的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:08
     */
    public function this_monday($timestamp=0,$is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $monday_date = date('Y-m-d', $timestamp-86400*date('w',$timestamp)+(date('w',$timestamp)>0?86400:-/*6*86400*/518400));
            if($is_return_timestamp){
                $cache[$id] = strtotime($monday_date);
            }else{
                $cache[$id] = $monday_date;
            }
        }
        return $cache[$id];

    }

    /**
     * 这个星期的星期天
     * @param int $timestamp 某个星期的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:09
     */
    public function this_sunday($timestamp=0,$is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $sunday = $this->this_monday($timestamp) + /*6*86400*/518400;
            if($is_return_timestamp){
                $cache[$id] = $sunday;
            }else{
                $cache[$id] = date('Y-m-d',$sunday);
            }
        }
        return $cache[$id];
    }

    /**
     * 上周一
     * @param int $timestamp 某个星期的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:09
     */
    public function last_monday($timestamp=0,$is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $thismonday = $this->this_monday($timestamp) - /*7*86400*/604800;
            if($is_return_timestamp){
                $cache[$id] = $thismonday;
            }else{
                $cache[$id] = date('Y-m-d',$thismonday);
            }
        }
        return $cache[$id];
    }

    /**
     * 上个星期天
     * @param int $timestamp 某个星期的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:09
     */
    public function last_sunday($timestamp=0,$is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $thissunday = $this->this_sunday($timestamp) - /*7*86400*/604800;
            if($is_return_timestamp){
                $cache[$id] = $thissunday;
            }else{
                $cache[$id] = date('Y-m-d',$thissunday);
            }
        }
        return $cache[$id];

    }

    /**
     * 这个月的第一天
     * @param int $timestamp 某个月的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:10
     */
    public function this_month_first_day($timestamp = 0, $is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $firstday = date('Y-m-d', mktime(0,0,0,date('m',$timestamp),1,date('Y',$timestamp)));
            if($is_return_timestamp){
                $cache[$id] = strtotime($firstday);
            }else{
                $cache[$id] = $firstday;
            }
        }
        return $cache[$id];
    }

    /**
     * 这个月的第一天
     * @param int $timestamp 某个月的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:10
     */
    public function this_month_last_day($timestamp = 0, $is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $lastday = date('Y-m-d', mktime(0,0,0,date('m',$timestamp),date('t',$timestamp),date('Y',$timestamp)));
            if($is_return_timestamp){
                $cache[$id] = strtotime($lastday);
            }else{
                $cache[$id] = $lastday;
            }
        }
        return $cache[$id];
    }

    /**
     * 上个月的第一天
     * @param int $timestamp 某个月的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:10
     */
    public function last_month_first_day($timestamp = 0, $is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $firstday = date('Y-m-d', mktime(0,0,0,date('m',$timestamp)-1,1,date('Y',$timestamp)));
            if($is_return_timestamp){
                $cache[$id] = strtotime($firstday);
            }else{
                $cache[$id] = $firstday;
            }
        }
        return $cache[$id];
    }

    /**
     * 上个月的最后一天
     * @param int $timestamp 某个月的某一个时间戳，默认为当前时间
     * @param bool $is_return_timestamp 是否返回时间戳，否则返回时间格式
     * @return false|int|mixed|string
     * @date 2022/07/05 17:11
     */
    public function last_month_last_day($timestamp = 0, $is_return_timestamp=true){
        static $cache ;
        $id = $timestamp.$is_return_timestamp;
        if(!isset($cache[$id])){
            if(!$timestamp) $timestamp = time();
            $lastday = date('Y-m-d', mktime(0,0,0,date('m',$timestamp)-1, date('t',$this->lastmonth_firstday($timestamp)),date('Y',$timestamp)));
            if($is_return_timestamp){
                $cache[$id] = strtotime($lastday);
            }else{
                $cache[$id] =  $lastday;
            }
        }
        return $cache[$id];
    }
}