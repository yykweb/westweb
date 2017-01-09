<?php
namespace app\admin\controller;

use app\admin\model\AdminUser;
use houdunwang\code\Code;
use houdunwang\crypt\Crypt;
use houdunwang\db\Db;
use houdunwang\rbac\Rbac;
use houdunwang\request\Request;
use houdunwang\session\Session;

class Index extends Base
{
    public function index()
    {
        $header = Db::table('webinfo')->where('id',1)->get();
        //echo Crypt::encrypt('admin');
        //print_r($header);
        return view()->with('header',$header[0]);
    }

    public function login(){//管理员用户登录方法

        if(!IS_POST) go('home.index.index',2,'非法访问');
        if(!Code::auth('verify')){ //判断验证码是否正确
            //$this->error('验证码输入错误！');
            go('admin.index.index',3,'验证码错误，请重试！');
        }
        $password = Request::post('admin_pass');
        $admin = AdminUser::find(1); //查询数据库用户是否存在
        //判断密码是否匹配
       // $pass = $iishost->PwdCP($password, $admin['admin_pass']);

        if($admin['admin_pass'] != Crypt::encrypt($password)){ //匹配用户名和密码
            go('admin.index.index',3,'密码或账号错误！请重试！');
        }

        //设置session

        Session::set('admin_log',time());
        //管理员登录时的session_id
        Session::set('session_admin_id',md5(mt_rand(1,1000)));
        Session::set('admin_user',$admin['admin_user']);
        Session::set('admin_logtime',date('Y-m-d H:i',$admin['admin_login_time']));
        Session::set('admin_uid',$admin['id']);
        Session::set('admin_logip',$admin['admin_login_ip']);


        if($admin['admin_login_lock']== 1) $this->error('该管理员用户已被禁用！'); //判断管理员用户是否被禁用


        Session::set(c('rbac.auth_key'),$admin['id']);

        if($admin['admin_user'] == c('rbac.super_user')){
            Session::set(c('auth_key'), true);
        }

        //Rbac::verify();


        $data = array(
            'id' => $admin['id'],
            'admin_login_time' => time(),
            'admin_login_ip' => Request::ip(),
            'session_id' => Session::get('session_admin_id')
        );

        AdminUser::where('id',1)->update($data); //更新数据

        go('admin/main/index');

    }


    public function logout(){//退出管理方法
        Session::del('admin_log');
        Session::del('admin_user');
        Session::del('admin_uid');
        Session::del('session_admin_id');

        go('home/index/index');
    }

}