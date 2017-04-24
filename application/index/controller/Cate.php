<?php
namespace app\index\controller;
use app\index\controller\BaseController;
use think\Db;

class Cate extends BaseController
{
    public function index()
    {
        $cateid = input('cateid');
        //查询当前栏目名称
        $cates = Db::name('cate')->find($cateid);
        $this->assign('cates', $cates);
        //查询当前栏目下的文章
        $articleres = Db::name('article')->where(array('cateid'=>$cateid))->paginate(3);
        $this->assign('articleres', $articleres);
        return $this->fetch('cate');
    }
}
