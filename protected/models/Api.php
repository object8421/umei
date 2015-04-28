<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/2
 * Time: 上午9:34
 */

class Api {
    static public function get($controller, $action, $param=array()){
        $url = "http://".Yii::app()->params['api_host']."/$controller/$action";
        $result = self::request($url, $param);
        Yii::log($url."?".http_build_query($param), 'warning');
        return json_decode($result, true);
    }

    static public function request($url, $param=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        if ($param)
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
        }
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    static function getData($controller, $action, $param=array()){
        $result = Api::get($controller, $action, $param);
        if(isset($result['result']) && $result['result'] == 0) {
            return $result['data'];
        }else{
            return false;
        }
    }
}
