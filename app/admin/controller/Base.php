<?php
namespace app\admin\controller;
use houdunwang\code\Code;
use houdunwang\controller\Controller;

class Base extends Controller
{
    public function code()
    {
        Code::make();
    }
}