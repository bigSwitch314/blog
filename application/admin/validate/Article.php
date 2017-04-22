<?php
namespace app\admin\validate;
use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title' => 'require|max:35',
        'cateid' => 'require'
    ];

    protected $message = [
        'title.require' => '文章标题必须填写',
        'title.max' => '文章标题长度不能大于35位',
        'cateid.reuire' => '请选择文章所属栏目'
    ];

    protected $scene = [
        'add' => ['title', 'cateid'],
        'edit' => ['title', 'cateid']
    ];
}
