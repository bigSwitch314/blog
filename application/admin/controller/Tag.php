<?php
namespace app\admin\controller;
//use app\admin\model\Link as LinkModel;
use think\Db;
use app\admin\controller\BaseController;

class Tag extends BaseController
{
    public function lst()
    {
        $list = Db::name('tags')->paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'tagname' => input('tagname'),
            ];
            $validate = \think\Loader::validate('Tag');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('tags')->insert($data)) {
                return $this->success('添加标签成功！', 'lst');
            } else {
                return $this->error('添加标签失败！');

            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $tag = Db::name('tags')->find($id);
        if (request()->isPost()) {
            $data = [
                'id'    => input('id'),
                'tagname' => input('tagname'),
            ];
            $validate = \think\Loader::validate('Tag');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('tags')->update($data)) {
                $this->success('修改标签成功！', 'lst');
            } else {
                $this->success('修改标签失败！');
            }
        }
        $this->assign('tag', $tag);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if (Db::name('tags')->delete($id)) {
            $this->success('删除标签成功！', 'lst');
        } else {
            $this->error('删除标签失败！');

        }

    }


}
