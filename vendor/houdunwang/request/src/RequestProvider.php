<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace houdunwang\request;

use houdunwang\framework\build\Provider;

class RequestProvider extends Provider {
	//延迟加载
	public $defer = false;

	public function boot() {
		Request::get();
	}

	public function register() {
		$this->app->single( 'Request', function () {
			return Request::single();
		} );
	}
}