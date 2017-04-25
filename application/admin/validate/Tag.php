<?php
namespace app\admin\validate;
use think\Validate;

class Tag extends Validate
{
    protected $rule = [
        'tagname' => 'require|max:25|unique:tags',
    ];

    protected $message = [
        'tagname.require' => '标签必须填写',
        'tagname.max' => '标签长度不能大于25位',
        'tagname.unique' => '标签不能重复',
    ];

    protected $scene = [
        'add' => ['tagname'],
        'edit' => ['tagname'],
    ];
}
