<?php
namespace app\index\controller;
use app\index\controller\BaseController;
use think\Db;

class Search extends BaseController
{
    public function index()
    {
        $keywords = input('keywords');
        if(!empty($keywords)){
            $map['title'] = ['like','%'.$keywords.'%'];
            $search = Db::name('article')->where($map)->order('id desc')->paginate($listRow = 2, $simple = false, $config = [
                'query' => array('keywords' => $keywords),

            ] );
            $this->assign(array(
                'search' => $search,
                'keywords' => $keywords,
            ));
        }else{
            $this->assign(array(
                'search' => null,
                'keywords' => '暂无数据',
            ));
        }
        return $this->fetch('search');
    }
}
