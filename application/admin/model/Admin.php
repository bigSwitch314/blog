<?php
namespace app\admin\model;
use think\Model;
use think\Db;
use think\Session;
use think\captcha\Captcha;

class Admin extends Model
{
    public function login($data){
        $captcha = new Captcha();
        if(!$captcha->check($data['code'])){
            return 4;
        }
        $user = DB::name('admin')->where('username', '=', $data['username'])->find();
        if($user){
            if($user['password']==md5($data['password'])){
                Session::set('username', $user['username']);
                Session::set('uid', $user['id']);
                return 3;//等成功
            }else{
                return 2;//密码错误
            }

        }else{
            return 1;//用户不存在
        }
    }

}
