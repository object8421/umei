<?php
/**
 * Created by PhpStorm.
 * User: caoxiang
 * Date: 15/3/17
 * Time: 下午4:38
 */

return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'优美网',

    // preloading 'log' component
    'preload'=>array('log'),

    // autoloading model and component classes
    'import'=>array(
        'application.models.*',
        'application.components.*',
        'ext.redis.*',
    ),

    'modules'=>array(
    ),

    // application components
    'components'=>array(
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                '<id:\d+>'=>'site/room',
                '<action:\w+>'=>'site/<action>',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ),
        ),
        'errorHandler'=>array(
            // use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),
    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'=>array(
        // this is used in contact page
        'adminEmail'=>'caoxiang@uumie.com',
        'coin_scale' => 100,

        'alipay_charset' => 'utf-8',  // utf-8 or gbk
        'alipay_key' => 'rck57qgi4djew019vx9jzlxfbo4ldkcu',
        'alipay_partner' => '2088712173953480',
        'alipay_seller_email' => "luxuanye@uumie.com",
        'alipay_cacert' => dirname(__FILE__).'/../data/cacert.pem',
    ),
);
