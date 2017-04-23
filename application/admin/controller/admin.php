<?php
namespace app\admin\controller;
use app\admin\model\Admin as AdminModel;
use app\admin\controller\BaseController;
use think\Db;
use think\Session;

class Admin extends BaseController
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
                'password' => input('password')
            ];
            //数据验证
            $validate = \think\Loader::validate('Admin');
            //密码加密前，只验证密码
            if(!$validate->scene('checkpw')->check($data)){
                $this->error($validate->getError());
                die;
            }
            //密码加密后，不验证密码
            $data['password'] = md5($data['password']);
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
            $data = [
                'id' => input('id'),
                'username' => input('username'),
                'password' => input('password')
            ];
            //数据验证
            $validate = \think\Loader::validate('Admin');
            //echo empty($data['password']);die;
            if(empty($data['password'])){
                $data['password'] = $admin['password'];
                if(!$validate->scene('add')->check($data)){
                    $this->error($validate->getError());
                    die;
                }
            }else{
                //密码加密前，只验证密码
                if(!$validate->scene('checkpw')->check($data)){
                    $this->error($validate->getError());
                    die;
                }
                //密码加密后，不验证密码
                $data['password'] = md5($data['password']);
                if(!$validate->scene('add')->check($data)){
                    $this->error($validate->getError());
                    die;
                }
            }
            $save = Db::name('admin')->update($data);
            if(false !== $save){
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

    public function logout()
    {
        Session::clear();
        $this->success('退出成功！', 'login/index');

    }



}
