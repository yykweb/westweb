<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <css file="__ROOT__/resource/admin/css/style_admin.css"/>
    <css file="__ROOT__/resource/admin/css/css.css"/>
    <js file="__ROOT__/resource/admin/js/submit.js"/>
    <title>零度网|管理平台</title>

</head>

<body>
<div id="heard">
    <div class="logo"><img src={{__ROOT__}}/uploads/{{$header[weblogo]}} width="185" height="49" border="0" /></div>
    <div class="tuichu"><a href='{{U("admin/index/logout")}}' target='_top' style="color:#000; text-decoration:none">退出</a></div>
    <div class="xinxi"><a href="__APP__/admin/customer/question_index/status/1" target='frmright' style="color:#000; text-decoration:none;" >提问<font color='red'><b>({{$count}})</b></font><span id='no'></span></a>&nbsp;&nbsp;
        <a href="__APP__/admin/webset/clear" target='frmright' style="color:#000; text-decoration:none;" onclick="return yesno('确定要清除网站缓存吗？');" >清除网站缓存</a></div>
    <div class="fenge"></div>
</div>
</body>
</html>
