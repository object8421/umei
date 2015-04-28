<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/17
 * Time: 下午4:39
 */

$conf = array(
    'modules'=>array(
        'gii'=>array(
            'class'=>'system.gii.GiiModule',
            'password'=>'umei',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters'=>array('127.0.0.1','::1'),
        ),
    ),
    'components'=>array(
        "redis" => array(
            "class" => "ext.redis.ARedisConnection",
            "hostname" => "127.0.0.1",
            "port" => 6379,
            "database" => 8,
            "prefix" => "um."
        ),
        'cache'=>array(
            'class'=>'system.caching.CMemCache',
            'servers'=>array(
                array('host'=>'127.0.0.1', 'port'=>11211, 'weight'=>100),
            ),
            'keyPrefix' => 'umweb:',
            'hashKey' => false,
        ),
        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=umei',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    ),
    'params'=>array(
        // this is used in contact page
        'api_host' => 'api.uumie.cn',
        'web_host' => 'new.uumie.cn',
    )
);
$common = include('common.php');
return array_merge_recursive($common, $conf);
