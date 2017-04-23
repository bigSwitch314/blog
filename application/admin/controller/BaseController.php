<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;

class BaseController extends Controller
{
    public function _initialize()
    {
        if(!Session::get('username')){
            $this->error('请先登录系统！', 'login/index');
        }
    }

}
