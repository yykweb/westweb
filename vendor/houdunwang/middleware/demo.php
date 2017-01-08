<?php
require 'vendor/autoload.php';
$config = [
	/**
	 * 全局中间件
	 * 只有全局中间件不需要指定下标
	 * 全局中间件系统会自动执行不需要人为操作
	 */
	'global'     => [ ],
	/**
	 * 控制器中间件
	 * 需要定义数组下标
	 * 一般在控制器的构造函数中执行
	 * 需要使用相应方法触发请查看手册
	 */
	'controller' => [ ],
	/**
	 * 应用中间件
	 * 需要定义数组下标
	 * 根据业务需要可以在任何位置执行
	 */
	'web'        => [ ]
];
\houdunwang\config\Config::set( 'middleware', $config );