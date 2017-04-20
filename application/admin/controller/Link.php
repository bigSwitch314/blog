<?php
namespace app\admin\controller;

use think\Controller;
use app\admin\model\Link as LinkModel;
use think\Db;

class Link extends Controller
{
    public function lst()
    {
        $list = LinkModel::paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'title' => input('title'),
                'url' => (input('url')),
                'desc' => (input('desc'))
            ];
            $validate = \think\Loader::validate('Link');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('Link')->insert($data)) {
                return $this->success('添加连接成功！', 'lst');
            } else {
                return $this->error('添加连接失败！');

            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $link = Db::name('Link')->find($id);
        if (request()->isPost()) {
            $data = [
                'id'    => input('id'),
                'title' => input('title'),
                'url'   => input('url'),
                'desc'  => input('desc')
            ];
            $validate = \think\Loader::validate('Link');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('Link')->update($data)) {
                $this->success('修改管理员成功！', 'lst');
            } else {
                $this->success('修改管理员失败！');
            }
        }
        $this->assign('link', $link);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if (Db::name('Link')->delete($id)) {
            $this->success('删除连接成功！', 'lst');
        } else {
            $this->error('删除连接失败！');

        }

    }


}
