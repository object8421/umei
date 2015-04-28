<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/17
 * Time: 下午4:41
 */

$conf = array(
    'components'=>array(
        "redis" => array(
            "class" => "ext.redis.ARedisConnection",
            "hostname" => "172.23.11.5",
            "port" => 6379,
            "database" => 8,
            "prefix" => "um."
        ),
        'cache'=>array(
            'class'=>'system.caching.CMemCache',
            'servers'=>array(
                array('host'=>'172.23.11.5', 'port'=>11211, 'weight'=>100),
            ),
            'keyPrefix' => 'umweb:',
            'hashKey' => false,
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=172.23.11.6;dbname=chat',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'qaz~!@',
            'charset' => 'utf8',
        ),
    ),
    'params'=>array(
        'api_host' => 'api.uumie.com',
        'web_host' => 'www.uumie.com',
    ),
);
$common = include('common.php');
return array_merge_recursive($common, $conf);