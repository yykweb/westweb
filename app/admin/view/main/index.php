<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <css file="__ROOT__/resource/admin/css/style_admin.css"/>
    <css file="__ROOT__/resource/admin/css/css.css"/>
    <title>零度网|管理平台</title>

</head>

<body style="overflow-y:hidden">

<div id="main">
    <IFRAME style="WIDTH: 100%; HEIGHT:83px; overflow:hidden%;" src="{{U('admin/main/top')}}" frameBorder="0" name="top" scrolling="no"></IFRAME>
    <div id="weizhi"><H3>当前位置：>> <SPAN> 网站管理平台</SPAN></H3></div>
    <div id="rightside">
        <IFRAME style="WIDTH: 100%; HEIGHT: 800px; inherit: inherit" src="{{U('admin/main/right')}}" frameBorder="0"  scrolling="auto" id="frmright" name="frmright"></IFRAME>
    </div>
    <div id="leftside">
        <IFRAME style="WIDTH: 100%; HEIGHT: 100%; VISIBILITY: inherit" id="top" src="{{U('admin/main/left')}}" frameBorder="0" name="top" scrolling="no"></IFRAME>
    </div>
</div>
</body>
</html>
