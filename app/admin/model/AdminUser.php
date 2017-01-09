<?php
namespace app\admin\model;
use houdunwang\model\Model;

class AdminUser extends Model
{
    protected $table = 'admin_login';
    protected $pk = 'id';
}