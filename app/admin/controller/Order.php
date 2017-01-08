<?php
namespace app\admin\controller;

use houdunwang\view\View;

class Order extends Base
{
    /**后台订单列表
     * @return mixed
     */
    public function index()
    {
        return view();
    }

    /**
     * 订单编辑
     */
    public function edit()
    {

    }

    public function view()
    {
        return view()->with('data',array('title'=>'订单列表','content'=>'订单管理'));
    }
}