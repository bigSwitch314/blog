<?php
namespace app\index\controller;

use app\index\controller\BaseController;
use think\Db;

class Article extends BaseController
{
    public function index()
    {
        $arid = input('arid');
        //获取该文章详情
        $article = Db::name('article')->find($arid);
        //获取该文章所属栏目
        $cate = Db::name('cate')->find($article['cateid']);
        //获取推荐文章
        $recommend = Db::name('article')->where(array('cateid' => $article['cateid'], 'state' => 1))->limit(4)->select();
        //点击量自增
        Db::name('article')->where('id', '=', $arid)->setInc('click');
        //获取该文章的相关文章
        $relate = $this->relate($article['keywords'], $arid);
        $this->assign(array(
            'article' => $article,
            'cate' => $cate,
            'recommend' => $recommend,
            'relate' => $relate,
        ));
        return $this->fetch('article');
    }

    public function searchtag()
    {
        //获取tag相同的文章
        $map['keywords'] = ['like', '%' . input('keywords') . '%'];
        $same_tag_article = Db::name('article')->where($map)->order('id desc')->limit(8)->paginate(2);
        $this->assign(array(
            'keywords' => input('keywords'),
            'same_tag_article' => $same_tag_article,
        ));
        return $this->fetch('searchtag');

    }

    public function relate($keywords, $id)
    {
        $arr = explode(',', $keywords);
        static $relatearr = array();

        foreach ($arr as $k => $v) {
            $map['keywords'] = ['like', '%' . $v . '%'];
            $map['id'] = ['neq', $id];
            $res = Db::name('article')->where($map)->order('id desc')->limit(8)->select();
            $relatearr = array_merge($relatearr, $res);
        }

        if (empty($relatearr)) {
            return null;
        }
        $relatearr = arr_unique($relatearr);
        return $relatearr;
    }
}
