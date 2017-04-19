<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require|max:25'
    ];

    protected $message = [
        'username.require' => '管理员名称必须填写',
        'username.max' => '管理员名称长度不能大于25位',
        'password.reuire' => '管理员密码必须填写'
    ];

    protected $scene = [
        'add' => ['username', 'password'],
        'edit' => ['username'],
    ];
}
