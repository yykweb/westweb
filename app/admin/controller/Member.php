<?php
namespace app\admin\controller;
use houdunwang\crypt\Crypt;
use houdunwang\db\Db;
use houdunwang\request\Request;
use houdunwang\view\View;

class Member extends Base
{
    public function index(){ //会员管理->显示所有的会员

        if(empty(Request::get('search')) && empty(Request::get('action'))){

            $count = Db::table('member_user')->join('member_level','member_user.member_level_id','=','member_level.id')->field('member_user.*,member_level.*')->count();
            //print_r($count);die;
            Page::desc(['pre'=>'上一页', 'next'=>'下一页','first'=>'首页','end'=>'尾页','unit'=>'个会员'])->row(c('app.pagesize'))->make($count);// 实例化分页类 传入总记录数 每10条记录为一页
            //$show = $Page->show();// 分页显示输出
            $member = Db::table('member_user')->join('member_level','member_user.member_level_id','=','member_level.id')->field('member_user.*,member_level.*')->get();
            //print_r($member);die;
           // $this->assign('list',$member); // 赋值数据集
            //$this->assign('page',Page::show()); // 赋值分页输出
            $this->member = $member;
            View::with('member',$member);
        }elseif(!empty(Request::get('search'))){

            $Data = M('member_user'); // 实例化Data数据对象

            import('ORG.Util.Page');// 导入分页类

            $where[$_GET['search']] = array('like',$_GET['content']."%");

            $count = $Data->where($where)->count();

            $Page = new Page($count,C('PAGE_SIZE'));
            $show = $Page->show();// 分页显示输出

            //从新接受url中的条件参数即可
            $map['search'] = $_GET['search'];
            $map['content'] = $_GET['content'];

            foreach($map as $key=>$val) {
                $Page->parameter .= "$key=".urlencode($val)."&";
            }


            // 进行分页数据查询
            $nowPage = isset($_GET['p'])?$_GET['p']:1;

            $list = $Data->where(array($where))->page($nowPage.','.$Page->listRows)->select();

            //$this->assign('list',$list); // 赋值数据集
            //$this->assign('page',$show); // 赋值分页输出
            $this->data = $data;
            $this->member = $list;
        }elseif(!empty($_GET['action'])){

            //组装升降、查询
            $merge = $_GET['by'].' '.$_GET['action'];

            $Data = M('member_user');

            import('ORG.Util.Page');

            $count = $Data->table('member_user U')->join('member_level N on U.id=N.id')->field('U.*,N.*')->count();

            $Page = new Page($count,C('PAGE_SIZE'));

            $show = $Page->show();

            // 进行分页数据查询
            $nowPage = isset($_GET['p'])?$_GET['p']:1;

            $member = $Data->table('member_user U')->join('member_level N on U.member_level_id=N.ID')->field('U.*,N.*')->order($merge)->page($nowPage.','.$Page->listRows)->select();

            //$this->assign('list',$list); // 赋值数据集

            //$this->assign('page',$show); // 赋值分页输出

            $this->data = $data;
            $this->member = $member;
        }
        return view();
    }


    //验证用户名是否正确
    public function ajax_user(){

        if(M('member_user')->where(array('username'=>$_POST['password']))->find()){
            echo json_encode('用户名已被注册!');
        }else{
            if(empty($_POST['password'])){
                echo json_encode('用户名不能为空！');
            }else{

                echo json_encode('该用户名可用!');
            }
        }

    }




    //显示会员添加界面
    public function add(){
        $level = Db::table('member_level')->get();
        return view()->with('level',$level);
    }


    //处理会员添加表单
    public function doadd(){

        if(!IS_POST) message('操作非法！','back','error'); //判断是否是当前register页面提交，防止非法提交

        if(!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]{3,16}$/is',Request::post('user_name'))){
            ajax('用户名字母开头且在3到16位之间!');
        }

        if(!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]{5,16}$/is',Request::post('user_password'))){
            ajax('密码字母开头且在6到16位之间!');
        }


        if(Request::post('user_password') != Request::post('rpassword')){
            ajax('两次密码输入不正确!');
        }

        if(!preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/is',Request::post('e_mail'))){
            ajax('请输入正确的邮箱格式!');
        }

        if(!preg_match("/^((\(\d{2,3}\))|(\d{3}\-))?1(3|5|8|9)\d{9}$/",Request::post('contact_tel'))){
            ajax('请输入正确的手机号!');
        }

        if(Db::table('member_user')->where('user_name',Request::post('user_name'))->get()){
            ajax('该用户名已经被注册！');
        }

        if(Db::table('member_user')->where('e_mail',Request::post('e_mail'))->get()){
            ajax('该邮箱已经被注册！');
        }

        if(Db::table('member_user')->where('contact_tel',Request::post('contact_tel'))->get()){
            ajax('该手机已经被注册！');
        }

        $data = Request::post();

        $data['user_regtime'] = time();

        $data['user_to_time'] =time();

        $data['user_password'] = Crypt::encrypt($data['user_password']) ;

        $back = Db::table('member_user')->insert($data);

        if($back){
            message('添加会员成功！','admin/member/index');
        }else{
            message('添加会员失败！','admin/member/index','error');
        }

    }


    //显示修改会员信息界面
    public function update(){
        //echo $_GET['user_name'];die;
        $member =Db::table('member_user')->where('user_name',Request::get('user_name'))->join('member_level','member_user.member_level_id','=','member_level.id')->field('member_user.*,member_level.*')->first();
        //print_r($member);die;
        $member_level = Db::table('member_level')->get();
        View::with('level',$member_level);
        return view()->with('data',$member);
    }


    //处理会员修改表单
    public function doupdate(){

        if(!IS_POST) message('非法操作！','home/index/index'); //判断是否是当前register页面提交，防止非法提交

        if(!empty(Request::post('user_password')) || !empty(Request::post('rpassword'))){
            if(!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]{5,16}$/is',Request::post('user_password'))){
                ajax('密码必须在6到16位之间!');
            }
        }

        if(!preg_match('/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/is',Request::post('e_mail'))){
            ajax('请输入正确的邮箱格式!');
        }

        if(!preg_match("/^((\(\d{2,3}\))|(\d{3}\-))?1(3|5|8|9)\d{9}$/",Request::post('contact_tel'))){
            ajax('请输入正确的手机号!');
        }

        $member = Db::table('member_user')->where('id',Request::post('id'))->get();


        if($member[0]['e_mail'] != Request::post('e_mail')){

            if(Db::table('member_user')->where('e_mail',Request::post('e_mail'))->get()){
                ajax('该邮箱已经被注册！');
            }
        }


        if($member[0]['contact_tel'] != Request::post('contact_tel')){

            if(Db::table('member_user')->where('contact_tel',Request::post('contact_tel'))->get()){
                ajax('该手机已经被注册！');

            }
        }


        if(!empty(Request::post('user_password'))){
            $password = Crypt::encrypt(Request::post('user_password'));
        }else{
            $password = $member[0]['user_password'];
        }


        $data = array(
            'user_password' => $password,
            'member_level_id' => Request::post('member_level_id'),
            'e_mail' => Request::post('e_mail'),
            'contact_tel' => Request::post('contact_tel'),
            'last_name' => Request::post('last_name'),
            'openqq_id' => Request::post('openqq_id'),
        );



        $add = Db::table('member_user')->where('id',Request::post('id'))->update($data);

        if($add){
            ajax('修改成功！');
        }else{

            ajax('修改失败(或未修改)！');
        }


    }


    //删除会员方法
    public function delete(){
        if(!IS_POST) message('非法提交！','back','error');

        if(!empty(Request::post('id'))){
            foreach(Request::post('id') as $v){

                if(Db::table('domain_busines')->where('member_user',$v)->get()){
                    ajax('存在产品的会员账号，不能被删除.(删除前，先转移产品或删除产品)!');
                }

                if(Db::table('host_busines')->where('member_user',$v)->get()){
                    ajax('存在产品的会员账号，不能被删除.(删除前，先转移产品或删除产品)!');
                }

                if(Db::table('mail_busines')->where('member_user',$v)->get()){
                    ajax('存在产品的会员账号，不能被删除.(删除前，先转移产品或删除产品)!');
                }

                if(Db::table('mssql_busines')->where('member_user',$v)->get()){
                    ajax('存在产品的会员账号，不能被删除.(删除前，先转移产品或删除产品)!');
                }

                if(Db::table('mysql_busines')->where('member_user',$v)->get()){
                    ajax('存在产品的会员账号，不能被删除.(删除前，先转移产品或删除产品)!');
                }


                $data = Db::table('member_user')->where(array('user_name'=>array('in',$v)))->delete();


            }

            if($data){
                message('删除成功！','admin/member/index');
            }else{
                message('删除失败！','back','error');
            }

        }else{
            ajax('请选择要删除的用户!');
        }







    }




    public function l_index(){ //会员等级->显示所有会员的等级

        $list = M('member_level')->select();

        $this->level = $list;

        $this->display();
    }

    public function l_add(){//添加等级页面
        $this->display();
    }

    public function l_doadd(){ //处理等级页面表单
        if(!IS_POST) halt('非法提交！');

        if(empty($_POST['Member_Level'])){
            ajax('用户等级不能为空！');
        }

        if(empty($_POST['Domain_Disount']) || empty($_POST['Other_Disount'])){
            ajax('域名差价或产品折扣不能为空！');
        }

        if($_POST['Member_Advance'] < 0){
            ajax('需要预付款金额不能小于0元');
        }

        if(I('Member_Advance') < 0 || I('Member_Advance') >10000){
            ajax('需要预付款金额必须是0-10000之间！');
        }

        if(I('Domain_Disount') < 0 || I('Domain_Disount') >10000){
            ajax('域名差价在0-10000之间!');
        }

        if(I('Other_Disount') < 1 || I('Other_Disount') > 10){
            ajax('折扣必须在1-10之间！');
        }

        if(M('member_level')->data($_POST)->add()){
            $this->success('添加等级成功！','__APP__/admin/member/l_index');
        }else{
            ajax('添加等级失败！');

        }

    }


    public function l_update(){

        $level = M('member_level')->where(array('ID'=>I('id')))->find();

        $this->level = $level;

        $this->display();
    }


    public function l_doupdate(){

        if(!IS_POST) halt('非法提交！');

        if(empty($_POST['Member_Level'])){
            ajax('用户等级不能为空！');
        }

        if(empty($_POST['Domain_Disount']) || empty($_POST['Other_Disount'])){
            ajax('域名差价或产品折扣不能为空！');
        }

        if($_POST['Member_Advance'] < 0){
            ajax('需要预付款金额不能小于0元');
        }

        if(I('Member_Advance') < 0 || I('Member_Advance') >10000){
            ajax('需要预付款金额必须是0-10000之间！');
        }

        if(I('Domain_Disount') < 0 || I('Domain_Disount') >10000){
            ajax('域名差价在0-10000之间!');
        }

        if(I('Other_Disount') < 1 || I('Other_Disount') > 10){
            ajax('折扣必须在1-10之间！');
        }


        if(M('member_level')->where(array('ID'=>I('id')))->data($_POST)->save()){
            $this->success('修改等级成功！','',1);
        }else{
            ajax('修改等级失败！');
        }

    }


    public function l_delete(){
        if(!IS_POST) ajax('非法提交！');

        if(!empty($_POST['id'])){
            foreach($_POST as $v){
                $data = M('member_level')->where(array('ID'=>array('in',$v)))->delete();
            }

            if($data){
                $this->success('删除成功！','l_index');
            }else{
                ajax('删除失败！');
            }

        }else{
            ajax('请选择要删除!');
        }
    }
}