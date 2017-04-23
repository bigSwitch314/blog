<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username' => 'require|max:25|unique:admin',
        'password' => 'require|max:25'
    ];

    protected $message = [
        'username.require' => '管理员名称必须填写',
        'username.max' => '管理员名称长度不能大于25位',
        'username.unique' => '该管理员名称已存在',
        'password.reuire' => '管理员密码必须填写'
    ];

    protected $scene = [
        'checkpw' => ['password'],
        'add' => ['username'],
        'edit' => ['username'],
    ];
}
