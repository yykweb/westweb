<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <css file="__ROOT__/resource/admin/css/style_admin.css"/>
    <css file="__ROOT__/resource/admin/css/nav.css"/>
    <title>零度网|管理平台</title>

</head>

<body>
<div class="user">
    <p class="n1"><span>{{$admin_user}}</span>,欢迎您！</p>
    <p class="n3">上次登录时间：<span>{{$time}}</span> </p>
    <!--p class="n3">上次登录地址：<span>{$area.country} {$area.area}</span></p>-->
    <p class="chongzhi"></p>
</div>
<ul class="accordion">
    <li id="one"><a href="#one">产品管理</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/product/domain_index" target="frmright">域名管理</a></li>
            <li><a href="__APP__/admin/product/host_index" target="frmright">虚拟主机管理</a></li>
            <li><a href="__APP__/admin/product/host_domain_index" target="frmright">主机域名管理</a></li>
            <li><a href="__APP__/admin/product/mail_index" target="frmright">企业邮局管理</a></li>
            <li><a href="__APP__/admin/product/mssql_index" target="frmright">MSSQL数据库管理</a></li>
            <li><a href="__APP__/admin/product/mysql_index" target="frmright">MYSQL数据库管理</a></li>
        </ul>
    </li>
    <li id="two"><a href="#two">产品列表</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/product2/pro_class" target="frmright">产品分类管理</a></li>
            <li><a href="__APP__/admin/product2/domain_index" target="frmright">域名产品</a></li>
            <li><a href="__APP__/admin/product2/psitehost_index" target="frmright">虚拟主机产品</a></li>
            <li><a href="__APP__/admin/product2/pmail_index" target="frmright">企业邮局产品</a></li>
            <li><a href="__APP__/admin/product2/pmssql_index" target="frmright">MSSQL数据库产品</a></li>
            <li><a href="__APP__/admin/product2/pmysql_index" target="frmright">MYSQL数据库产品</a></li>
            <li><a href="__APP__/admin/product2/pvps_index" target="frmright">VPS主机产品</a></li>
            <li><a href="__APP__/admin/product2/pserver_index" target="frmright">服务器租用产品</a></li>
            <!--<li><a href="#" target="frmright">网站建设管理</a></li>-->
        </ul>
    </li>
    <li id="three"><a href="#three">会员账号管理</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/member/m_index" target="frmright" class="likelogin">会员管理</a></li>
            <li><a href="__APP__/admin/member/l_index" target="frmright">会员等级</a></li>
        </ul>
    </li>
    <li id="four"> <a href="#four">财务管理</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/money/order_action" target="frmright">财务操作</a></li>
            <li><a href="__APP__/admin/money/order_record" target="frmright">财务记录</a></li>
            <li><a href="__APP__/admin/money/payment_api" target="frmright">支付接口</a></li>
            <li><a href="__APP__/admin/money/bank_index" target="frmright">银行信息</a></li>
        </ul>
    </li>
    <li id="five"><a href="#five">客户服务</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/customer/question_index" target="frmright">问题管理</a></li>

            <li><a href="__APP__/admin/customer/notice_index" target="frmright">消息发布</a></li>
        </ul>
    </li>
    <li id="six"> <a href="#six">网站信息管理</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/webinfo/index" target="frmright">基本信息</a></li>
            <li><a href="__APP__/admin/webinfo/bulletin_index" target="frmright">最新公告</a></li>
            <li><a href="__APP__/admin/webinfo/companynews_index" target="frmright">公司动态</a></li>
            <li><a href="__APP__/admin/webinfo/help_index" target="frmright">帮助中心</a></li>
            <li><a href="__APP__/admin/webinfo/advertise_index" target="frmright">图片广告</a></li>
            <li><a href="__APP__/admin/webinfo/sitecase_index" target="frmright">网站案例</a></li>
            <li><a href="__APP__/admin/webinfo/about" target="frmright">关于我们</a></li>
            <li><a href="__APP__/admin/webinfo/contactus" target="frmright">联系我们</a></li>
        </ul>
    </li>
    <li id="seven"> <a href="#seven">网站设置管理</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/webset/croom_index" target="frmright">机房位置分类</a></li>
            <li><a href="__APP__/admin/webset/server_index" target="frmright">服务器管理</a></li>
            <li><a href="__APP__/admin/webset/space_path_index" target="frmright">服务器空间存放路径</a></li>
            <li><a href="__APP__/admin/webset/domain_api_index" target="frmright">域名API接口</a></li>
            <li><a href="__APP__/admin/webset/allow_qq" target="frmright">使用QQ账号登录设置</a></li>
            <li><a href="__APP__/admin/webset/smtp_set" target="frmright">邮件SMTP设置</a></li>
            <li><a href="__APP__/admin/webset/mail_model_reg" target="frmright">邮件模板</a></li>
            <li><a href="__APP__/admin/webset/restoration" target="frmright">重装系统IIS数据恢复</a></li>
        </ul>
    </li>
    <li id="eight"> <a href="#eight">管理员设置</a>
        <ul class="sub-menu">
            <li><a href="__APP__/admin/rbac/index" target="frmright">管理员用户列表</a></li>
            <li><a href="__APP__/admin/adminset/update_pw" target="frmright">修改登录密码</a></li>
            <li><a href="__APP__/admin/rbac/role" target="frmright">角色列表</a></li>
            <li><a href="__APP__/admin/rbac/node" target="frmright">节点列表</a></li>
            <li><a href="__APP__/admin/rbac/adduser" target="frmright">添加用户</a></li>
            <li><a href="__APP__/admin/rbac/addrole" target="frmright">添加角色</a></li>
            <!--<li><a href="__APP__/admin/rbac/addnode" target="frmright">添加节点</a></li>-->
        </ul>
    </li>
</ul>
<js file="__ROOT__/resource/admin/css/jquery.min.js"/>
<script type="text/javascript">
    $(document).ready(function() {
        // Store variables
        var accordion_head = $('.accordion > li > a'),
            accordion_body = $('.accordion li > .sub-menu');
        // Open the first tab on load
        accordion_head.first().addClass('active').next().slideDown('normal');
        // Click function
        accordion_head.on('click', function(event) {
            // Disable header links
            event.preventDefault();
            // Show and hide the tabs on click
            if ($(this).attr('class') != 'active'){
                accordion_body.slideUp('normal');
                $(this).next().stop(true,true).slideToggle('normal');
                accordion_head.removeClass('active');
                $(this).addClass('active');
            }
        });
    });
</script>
</body>
</html>
