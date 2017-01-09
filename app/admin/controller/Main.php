<?php
namespace app\admin\controller;
use app\admin\model\AdminUser;
use app\admin\model\Question;
use houdunwang\db\Db;
use houdunwang\session\Session;

class Main extends Base
{
    public function index()
    {
        return view();
    }

    public function left()
    {
        return view()->with('admin_user',Session::get('admin_user'))->with('time',Session::get('admin_logtime'));
    }

    public function right()
    {
        return view();
    }

    public function top()
    {
        $header = Db::table('webinfo')->where('id',1)->get();
        return view()->with('count',Question::where('status',1)->count())->with('header',$header[0]);
    }
}

//        import('ORG.Net.IpLocation');// 导入IpLocation类
//        $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
//        //$area = $Ip->getlocation('203.34.5.66'); // 获取某个IP地址所在的位置
//        $area = $Ip->getlocation($_SESSION['admin_logip']); // 获取某个IP地址所在的位置
//$this->count = $count;