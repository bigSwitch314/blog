<?php
namespace app\admin\controller;
use app\admin\model\Article as ArticleModel;
use app\admin\controller\BaseController;
use think\Db;

class Article extends BaseController
{
    public function lst()
    {
        $list = ArticleModel::paginate(3);
        //$list = Db::name('article')->alias('a')->join('cate c', 'c.id=a.cateid')->field('a.id, a.title, a.pic, a.author, a.state, c.catename')->paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'title'   => input('title'),
                'author'  => input('author'),
                'desc'    => input('desc'),
                'keywords' => input('keywords'),
                'content' => input('content'),
                'cateid'  => input('cateid'),
                'time'    => time(),
            ];
            $data['state'] = !empty(input('state'))? 1: 0;
            if(!empty($_FILES['pic']['tmp_name'])){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic'] = '/static/uploads/'.$info->getSavename();
            }
            $validate = \think\Loader::validate('Article');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('Article')->insert($data)) {
                return $this->success('添加文章成功！', 'lst');
            } else {
                return $this->error('添加文章失败！');

            }
        }
        $cateres = Db::name('cate')->select();
        $this->assign('cateres', $cateres);
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $article = Db::name('Article')->find($id);
        if (request()->isPost()) {
            $data = [
                'id'    => input('id'),
                'title' => input('title'),
                'author'   => input('author'),
                'keywords'   => input('keywords'),
                'content'   => input('content'),
                'cateid'   => input('cateid'),
                'desc'  => input('desc')
            ];
            $data['state'] = !empty(input('state'))? 1: 0;
            if(!empty($_FILES['pic']['tmp_name'])){
                //@unlink(SITE_URL.$article['pic']); //删除失败
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic'] = '/static/uploads/'.$info->getSavename();
            }
            $validate = \think\Loader::validate('Article');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('Article')->update($data)) {
                $this->success('修改文章成功！', 'lst');
            } else {
                $this->success('修改文章失败！');
            }
        }
        $cateres = Db::name('cate')->select();
        $this->assign('cateres', $cateres);
        $this->assign('article', $article);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if (Db::name('Article')->delete($id)) {
            $this->success('删除文章成功！', 'lst');
        } else {
            $this->error('删除文章失败！');

        }

    }


}
