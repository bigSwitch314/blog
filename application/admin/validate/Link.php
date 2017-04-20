<?php
namespace app\admin\validate;
use think\Validate;

class Link extends Validate
{
    protected $rule = [
        'title' => 'require|max:25',
        'url' => 'require|max:25'
    ];

    protected $message = [
        'title.require' => '连接标题必须填写',
        'title.max' => '连接标题长度不能大于25位',
        'url.reuire' => '连接地址必须填写'
    ];

    protected $scene = [
        'add' => ['title', 'url'],
        'edit' => ['title'],
    ];
}
