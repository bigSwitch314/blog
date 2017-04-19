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

}
