<?php namespace houdunwang\framework;

/*--------------------------------------------------------------------------
| Software: [HDPHP framework]
| Site: www.hdphp.com
|--------------------------------------------------------------------------
| Author: 向军 <2300071698@qq.com>
| WeChat: houdunwangxj
| Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
|-------------------------------------------------------------------------*/

use houdunwang\framework\build\Base;

class App {
	protected $link;

	public function __construct() {
		header( "Content-type:text/html;charset=utf-8" );

		/*--------------------------------------------------------------------------
		| 框架版本
		|--------------------------------------------------------------------------
		| Author: 向军 <2300071698@qq.com>
		| WeChat: houdunwangxj
		| Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
		|-------------------------------------------------------------------------*/
		define( 'HDPHP_VERSION', '3.0.45' );
	}

	//更改缓存驱动
	protected function driver() {
		$this->link = new Base();

		return $this;
	}

	public function __call( $method, $params ) {
		if ( is_null( $this->link ) ) {
			$this->driver();
		}

		return call_user_func_array( [ $this->link, $method ], $params );
	}

	//生成单例对象
	public static function single() {
		static $link;
		if ( is_null( $link ) ) {
			$link = new static();
		}

		return $link;
	}

	public static function __callStatic( $name, $arguments ) {
		return call_user_func_array( [ static::single(), $name ], $arguments );
	}
}
