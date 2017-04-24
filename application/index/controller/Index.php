<?php
namespace app\index\controller;
use app\index\controller\BaseController;
use think\Db;

class Index extends BaseController
{
    public function index()
    {
        $articles = Db::name('article')->order('id desc')->paginate(4);
        $this->assign('articles', $articles);
        return $this->fetch('index');
    }

}
