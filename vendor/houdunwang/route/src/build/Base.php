<?php
/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/
namespace houdunwang\route\build;

use houdunwang\cache\Cache;
use houdunwang\config\Config;
use houdunwang\controller\Controller;
use houdunwang\request\Request;

/**
 * 路由处理类
 * Class Route
 * @package hdphp\route
 */
class Base extends Compile {
	//路由定义
	public $route = [ ];
	//请求的URI
	protected $requestUri;
	//路由缓存
	protected $cache = [ ];
	//正则替换字符
	protected $patterns = [
		':num' => '[0-9]+',
		':all' => '.*',
	];

	//请求地址
	protected function getRequestUri() {
		if ( isset( $_SERVER['PATH_INFO'] ) ) {
			$REQUEST_URI = $_SERVER['PATH_INFO'];
		} else {
			if ( dirname( $_SERVER['SCRIPT_NAME'] ) != '/' ) {
				//有子目录的访问  hdphp/index.php形式
				$REQUEST_URI = str_replace( dirname( $_SERVER['SCRIPT_NAME'] ), '', $_SERVER['REQUEST_URI'] );
			} else {
				$REQUEST_URI = $_SERVER['REQUEST_URI'];
			}
		}
		$REQUEST_URI = trim( preg_replace( '/\w+\.php/i', '', $REQUEST_URI ), '/' );

		return $REQUEST_URI ? parse_url( $REQUEST_URI, PHP_URL_PATH ) : '';
	}

	/**
	 * 使用正则表达式限制参数
	 *
	 * @param mixed $name
	 * @param string $regexp
	 *
	 * @return $this
	 */
	public function where( $name, $regexp = '' ) {
		if ( is_array( $name ) ) {
			foreach ( $name as $k => $v ) {
				$this->route[ count( $this->route ) - 1 ]['where'][ $k ] = '#^' . $v . '$#';
			}
		} else {
			$this->route[ count( $this->route ) - 1 ]['where'][ $name ] = '#^' . $regexp . '$#';
		}

		return $this;
	}

	/**
	 * 解析标签
	 * @return bool|void
	 */
	public function dispatch() {
		//请求URL
		$this->requestUri = $this->getRequestUri();
		//设置路由缓存
		if ( Config::get( 'route.cache' ) && ( $route = Cache::get( '_ROUTES_' ) ) ) {
			$this->route = $route;
		} else {
			$this->route = $this->parseRoute();
		}
		//匹配路由
		foreach ( $this->route as $key => $route ) {
			$method = '_' . $route['method'];
			$this->$method( $key );
			if ( $this->found ) {
				return;
			}
		}
		//GET模式处理
		Controller::run();
	}

	/**
	 * 解析路由
	 */
	protected function parseRoute() {
		/**
		 * 为每一条路由规则生成正则表达式缓存
		 * 同时解析路由中的{name}等变量
		 * @var [type]
		 */
		foreach ( $this->route as $key => $value ) {
			//原始路由数据
			$regexp = $value['route'];
			//将:all等符号替换为标签路由字符
			if ( strpos( $regexp, ':' ) !== false ) {
				//替换正则符号
				$regexp = str_replace( array_keys( $this->patterns ), array_values( $this->patterns ), $regexp );
			}
			//将{name?}等替换为(.*?)形式
			preg_match_all( '#\{(.*?)(\?)?\}#', $regexp, $args, PREG_SET_ORDER );
			foreach ( $args as $i => $ato ) {
				//存在$ato[2]表示存在{name?}中的问号，用来设置正则中的?
				$has = isset( $ato[2] ) ? $ato[2] : '';
				if ( $has ) {
					//有{.*?}问号，表示变量是可选的，前面加? 组合成/? 形式
					//要不没变量时会多一个/
					$regexp = str_replace( $ato[0], '?([^/]+?)' . $has, $regexp );
				} else {
					$regexp = str_replace( $ato[0], '([^/]+?)' . $has, $regexp );
				}
			}
			$this->route[ $key ]['regexp'] = '#^' . $regexp . '$#';
			$this->route[ $key ]['args']   = $args;
		}
		//缓存路由
		if ( Config::get( 'route.cache' ) ) {
			Cache::set( '_ROUTES_', $this->route );
		}

		return $this->route;
	}

	/**
	 * 获取路由参数
	 *
	 * @param $name
	 *
	 * @return mixed|null
	 */
	public function input( $name = null ) {
		if ( is_null( $name ) ) {
			return $this->args;
		} else {
			return isset( $this->args[ $name ] ) ? $this->args[ $name ] : null;
		}
	}
}