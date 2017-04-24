<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class BaseController extends Controller
{
    public function _initialize()
    {
        $this->right();
        $cateres = Db::name('cate')->order('id asc')->select();
        $this->assign('cateres', $cateres);
    }

    public function right()
    {
        $click = Db::name('article')->order('click desc')->limit(4)->select();
        $recommend_all = Db::name('article')->where('state', '=', 1)->order('click desc')->limit(4)->select();
        $this->assign(array(
            'click'         => $click,
            'recommend_all' => $recommend_all,
        ));
    }

}
