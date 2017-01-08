# 语言

组件提供便捷的多语言支持，程序开发人员只需要配置好语言包即可实现多语言环境构建。 
其他产品也可以使用该组件，请登录 [GITHUB](https://github.com/houdunwang/lang) 查看源代码与说明文档。

[TOC]

##安装
使用 composer 命令进行安装或下载源代码使用。

```
composer require houdunwang/lang
```
> HDPHP 框架已经内置此组件，无需要安装

##操作
####配置
```
$config = [
	//语言包
	'file' => ROOT_PATH . '/system/zh.php',
];
\houdunwang\config\Config::set( 'lang', $config );
echo \houdunwang\lang\Lang::get( 'name' );
```

####设置语言包
除了可以使用配置文件外,也可以使用file() 方法动态设置语言包
```
\houdunwang\lang\Lang::file('zh.php');
```

####获取语言
```
echo \houdunwang\lang\Lang::get('web');
```

####设置语言
```
echo \houdunwang\lang\Lang::set('name','向军老师');
```