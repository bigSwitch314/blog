<?php
return [

    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__PUBLIC__' => SITE_URL.'/static/admin',
        '__IMG__' => SITE_URL,
    ],

    //Session配置参数
    'session' => [
        'prefix' => 'admin',
        'type' => '',
        'auto_start' => true,
    ],



];
