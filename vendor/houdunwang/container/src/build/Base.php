<?php namespace houdunwang\container\build;

/** .-------------------------------------------------------------------
 * |  Software: [HDCMS framework]
 * |      Site: www.hdcms.com
 * |-------------------------------------------------------------------
 * |    Author: 向军 <2300071698@qq.com>
 * |    WeChat: aihoudun
 * | Copyright (c) 2012-2019, www.houdunwang.com. All Rights Reserved.
 * '-------------------------------------------------------------------*/

use Closure;
use ArrayAccess;
use Exception;
use ReflectionClass;

class Base implements ArrayAccess {
	//绑定实例
	public $bindings = [ ];
	//单例服务
	public $instances = [ ];

	/**
	 * 服务绑定到容器
	 *
	 * @param $name 服务名
	 * @param $closure 返回服务对象的闭包函数
	 * @param bool $force 是否单例
	 */
	public function bind( $name, $closure, $force = false ) {
		$this->bindings[ $name ] = compact( 'closure', 'force' );
	}

	/**
	 * 注册单例服务
	 *
	 * @param $name 服务
	 * @param $closure 闭包函数
	 */
	public function single( $name, $closure ) {
		$this->bind( $name, $closure, true );
	}

	/**
	 * 单例服务
	 *
	 * @param string $name 名称
	 * @param mixed $object 对象
	 */
	public function instance( $name, $object ) {
		$this->instances[ $name ] = $object;
	}

	/**
	 * 获取服务实例
	 *
	 * @param $name 服务名
	 * @param bool $force 单例
	 *
	 * @return mixed|object
	 */
	public function make( $name, $force = false ) {
		if ( isset( $this->instances[ $name ] ) ) {
			return $this->instances[ $name ];
		}
		//获得实现提供者
		$closure = $this->getClosure( $name );
		//获取实例
		$object = $this->build( $closure );
		//单例绑定
		if ( isset( $this->bindings[ $name ]['force'] ) && $this->bindings[ $name ]['force'] || $force ) {
			$this->instances[ $name ] = $object;
		}

		return $object;
	}

	/**
	 * 获得实例实现
	 *
	 * @param $name 创建实例方式:类名或闭包函数
	 *
	 * @return mixed
	 */
	private function getClosure( $name ) {
		return isset( $this->bindings[ $name ] ) ? $this->bindings[ $name ]['closure'] : $name;
	}

	/**
	 * 依赖注入方式调用函数
	 *
	 * @param $function
	 *
	 * @return mixed
	 */
	public function callFunction( $function ) {
		$reflectionFunction = new \ReflectionFunction( $function );
		$args               = $this->getDependencies( $reflectionFunction->getParameters() );

		return $reflectionFunction->invokeArgs( $args );
	}

	/**
	 * 反射执行方法并实现依赖注入
	 *
	 * @param $class 类
	 * @param $method 方法
	 *
	 * @return mixed
	 */
	public function callMethod( $class, $method ) {
		//反射方法实例
		$reflectionMethod = new \ReflectionMethod( $class, $method );
		//解析方法参数
		$args = $this->getDependencies( $reflectionMethod->getParameters() );

		//生成类并执行方法
		return $reflectionMethod->invokeArgs( $this->build( $class ), $args );
	}

	/**
	 * 生成服务实例
	 *
	 * @param mixed $className 生成方式 类或闭包函数
	 *
	 * @return object
	 * @throws Exception
	 */
	public function build( $className ) {
		//匿名函数
		if ( $className instanceof Closure ) {
			//执行闭包函数
			return $className( $this );
		}
		//获取类信息
		$reflector = new ReflectionClass( $className );
		// 检查类是否可实例化, 排除抽象类abstract和对象接口interface
		if ( ! $reflector->isInstantiable() ) {
			throw new Exception( "$className 不能实例化." );
		}
		//获取类的构造函数
		$constructor = $reflector->getConstructor();
		//若无构造函数，直接实例化并返回
		if ( is_null( $constructor ) ) {
			return new $className;
		}
		//取构造函数参数,通过 ReflectionParameter 数组返回参数列表
		$parameters = $constructor->getParameters();
		//递归解析构造函数的参数
		$dependencies = $this->getDependencies( $parameters );

		//创建一个类的新实例，给出的参数将传递到类的构造函数。
		return $reflector->newInstanceArgs( $dependencies );
	}

	/**
	 * 递归解析参数
	 *
	 * @param $parameters
	 *
	 * @return array
	 * @throws Exception
	 */
	public function getDependencies( $parameters ) {
		$dependencies = [ ];
		//参数列表
		foreach ( $parameters as $parameter ) {
			//获取参数类型
			$dependency = $parameter->getClass();
			if ( is_null( $dependency ) ) {
				//是变量,有默认值则设置默认值
				$dependencies[] = $this->resolveNonClass( $parameter );
			} else {
				//是一个类,递归解析
				$dependencies[] = $this->build( $dependency->name );
			}
		}

		return $dependencies;
	}

	/**
	 * 提取参数默认值
	 *
	 * @param $parameter
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function resolveNonClass( $parameter ) {
		// 有默认值则返回默认值
		if ( $parameter->isDefaultValueAvailable() ) {
			return $parameter->getDefaultValue();
		}

		throw new Exception( '参数无默认值' );
	}

	public function offsetExists( $key ) {
		return isset( $this->bindings[ $key ] );
	}

	public function offsetGet( $key ) {
		return $this->make( $key );
	}

	public function offsetSet( $key, $value ) {
		if ( ! $value instanceof Closure ) {
			$value = function () use ( $value ) {
				return $value;
			};
		}

		$this->bind( $key, $value );
	}

	public function offsetUnset( $key ) {
		unset( $this->bindings[ $key ], $this->instances[ $key ] );
	}

	public function __get( $key ) {
		return $this[ $key ];
	}

	public function __set( $key, $value ) {
		$this[ $key ] = $value;
	}
}