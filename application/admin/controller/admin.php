<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Admin as adminModel;
use think\Db;

class Admin extends Controller
{
    public function lst()
    {
        $list = AdminModel::paginate(3);
        $this -> assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'username' => input('username'),
                'password' => (input('password'))
            ];
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
                die;
            }
           if(Db::name('admin')->insert($data)){
               return $this->success('添加管理员成功！', 'lst');
           }else{
               return $this->error('添加管理员失败！');

           }
        }
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $admin = Db::name('admin')->find($id);
        if(request()->isPost()){
            $password = input('password')? md5(input('password')): $admin['password'];
            $data = [
                'id' => input('id'),
                'username' => input('username'),
                'password' => $password
            ];
            $validate = \think\Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
                die;
            }
            if(Db::name('admin')->update($data)){
                $this->success('修改管理员成功！', 'lst');
            }else{
                $this->success('修改管理员失败！');
            }
        }
        $this->assign('admin', $admin);
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
        if(2!=$id){
            if(Db::name('admin')->delete($id)){
                $this->success('删除管理员成功！', 'lst');
            }else{
                $this->error('删除管理员失败！');

            }
        }else{
            $this->error('初始化管理员不能删除！');

        }

    }



}
