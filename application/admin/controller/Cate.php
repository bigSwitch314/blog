<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
use think\Db;
use app\admin\controller\BaseController;

class Cate extends BaseController
{
    public function lst()
    {
        $list = CateModel::paginate(3);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'catename' => input('catename'),
            ];
            $validate = \think\Loader::validate('Cate');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            if (Db::name('cate')->insert($data)) {
                return $this->success('添加栏目成功！', 'lst');
            } else {
                return $this->error('添加栏目失败！');

            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'catename' => input('catename'),
            ];
            $validate = \think\Loader::validate('Cate');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
                die;
            }
            $save = Db::name('Cate')->update($data);
            if ($save !== false) {
                $this->success('修改栏目成功！', 'lst');
            } else {
                $this->success('修改栏目失败！');
            }
            echo '41';
        }
        $id = input('id');
        $cate = Db::name('Cate')->find($id);
        $this->assign('cate', $cate);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if (Db::name('Cate')->delete($id)) {
            $this->success('删除栏目成功！', 'lst');
        } else {
            $this->error('删除栏目失败！');

        }


    }


}
