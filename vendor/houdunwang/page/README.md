#分页

分页组件可以产生基于当前页面的智能「范围」链接，所产生的 HTML 兼容 Bootstrap CSS 框架.

[TOC]

####安装组件
使用 composer 命令进行安装或下载源代码使用。

```
composer require houdunwang/page
```
> HDPHP 框架已经内置此组件，无需要安装

####根据数量获取分页
```
\houdunwang\page\Page::make(100);
```

####显示分页
```
\houdunwang\page\Page::show();
```

####获取所有分页属性
可以获取分页属性，如 文字页码、图形页码、下拉列表页码等
```
\houdunwang\page\Page::all(100);
```

####设置每页显示条数
```
\houdunwang\page\Page::row(8)->make(100);
```

####设置页码数量
```
\houdunwang\page\Page::pageNum(5)->make(100);
```

####自定义url
```
\houdunwang\page\Page::url('list/{page}.html')->make(100,1);
```

####定义显示文字
```
\houdunwang\page\Page::desc(['pre'=>'上楼', 'next'=>'下楼','first'=>'首页','end'=>'尾页','unit'=>'个'])->make(200,2);
```

####返回limit语句
```
\houdunwang\page\Page::limit();
```

####取得所有形式用于定义
```
\houdunwang\page\Page::all(200);
```

####获取分页的总页数
```
\houdunwang\page\Page::totalPage();
```