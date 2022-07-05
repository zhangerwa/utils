<?php

namespace Zhangerwa\Utils;

class Utils
{
    /**
     * GetSync PHP异步请求
     * @param string $path 请求地址
     * @param string $host 域名
     * @param array $post_data 请求数据
     * @param array $cookie
     * @return bool
     * @date 2022/07/05 16:54
     */
    public static function GetSync($path='', $host = '', $post_data = [], $cookie = [])
    {
        //如果path存在协议时，直接将path作为url处理
        if (strpos($path, 'http') === 0) {
            $url = $path;
        }else {
            //处理参数后组装为完整的URL
            if (empty ($host)) {
                $host = $_SERVER ['HTTP_HOST'];
            } else {
                $host = preg_replace('/[\w|:]*\/\//', '', $host);
            }
            if($path[0] !== '/')
            {
                $path = '/'.$path;
            }

            $url = 'http://'.$host.$path;
        }

        $url_arr = parse_url($url);
        $port = isset($url_arr['port'])?$url_arr['port']:80;
        if($url_arr['scheme'] == 'https'){
            $url_arr['host'] = 'ssl://'.$url_arr['host'];
        }

        $fp = fsockopen($url_arr['host'],$port,$errno,$errstr,30);
        if(!$fp) return false;
        $getPath = isset($url_arr['path'])?$url_arr['path']:'/';
        $getPath .= isset($url_arr['query'])?'?'.$url_arr['query']:'';
        $method = 'GET';  //默认get方式
        if(!empty($post_data)) $method = 'POST';
        $header = "$method  $getPath  HTTP/1.1\r\n";
        $header .= "Host: ".$url_arr['host']."\r\n";
        if(!empty($cookie)){  //传递cookie信息
            $_cookie = strval(NULL);
            foreach($cookie AS $k=>$v){
                $_cookie .= $k."=".$v.";";
            }
            $cookie_str = "Cookie:".base64_encode($_cookie)."\r\n";
            $header .= $cookie_str;
        }

        if(!empty($post_data)){  //传递post数据
            $_post = array();
            foreach($post_data AS $_k=>$_v){
                $_post[] = $_k."=".urlencode($_v);
            }
            $_post = implode('&', $_post);
            $post_str = "Content-Type:application/x-www-form-urlencoded; charset=UTF-8\r\n";
            $post_str .= "Content-Length: ".strlen($_post)."\r\n";  //数据长度
            $post_str .= "Connection:Close\r\n\r\n";
            $post_str .= $_post;  //传递post数据
            $header .= $post_str;
        }else{
            $header .= "Connection:Close\r\n\r\n";
        }
        fwrite($fp, $header);
        usleep(1000); // 这一句也是关键，如果没有这延时，可能在nginx服务器上就无法执行成功
        fclose($fp);

        return true;
    }

}
