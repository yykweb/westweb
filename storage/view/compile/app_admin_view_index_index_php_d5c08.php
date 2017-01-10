<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8" />
    <title><?php echo $header[sitetitle]?></title>
    <link type="text/css" rel="stylesheet" href="http://b.app/resource/admin/css/login.css"/>
    <script type="text/javascript" src="http://b.app/resource/admin/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="http://b.app/resource/admin/js/Ajax.js"></script>

    <script>
        function check(){

            if($('#username').val()==''){
                window.alert("请输入用户名！");
                $('#username').focus();
                return false;
            }

            if($('#password').val()==''){
                window.alert("请输入密码！");
                $('#password').focus();
                return false;
            }
            if($('#verify').val() == ''){
                window.alert('请输入验证码!');
                $('#verify').focus();
                return false;
            }

            openLayer('denglu','Layer');
            $('#sub').submit();
        }
    </script>

</head>
<body>

    <div id="top">
        <div class="cen">
            <div class="logo"><a href='<?php echo __ROOT__?>'><img src="<?php echo __ROOT__?>/uploads/<?php echo $header[weblogo]?>" width="252" height="71" border="0" /></a></div>
        </div>
    </div>
    <div id="center">
        <div class="cen">
            <div class="login_img"><img src="<?php echo __ROOT__?>/resource/admin/images/login_img.png" width="433" height="282" border="0" /></div>
            <div class="login_box">

                <div class="login">

                    <form name='sub' id='sub' action='<?php echo U("index/login")?>' method='post'>
                        <ul>
                            <li>用户名：</li>
                            <?php echo  csrf_field() ?>
                            <li><input class="txt2" type=text name='admin_user' id='username'></li>
                            <li>密码：</li>
                            <li><input class="txt2" type='password' name='admin_pass' id='password'></li>

                            <li style="padding-top:5px;">验证码：<img src='<?php echo U("base/code")?>' name='verify' onClick='this.src="<?php echo U('base/code')?>/"+Math.random()' />不区分大小写</li>
                            <li><input class="txt1" name='verify' type='text' id='verify'></li>

                            <li><input id="denglu" onclick="check();" type="button"></li>
                            <li><span class="font2" onclick></span></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="f_box">
        <div id="foot">
            <div class="box">
                <div id="bottom">
                    <p style="font-family: 'Microsoft JhengHei';font-size: 15px"><?php echo $header[bottominfo]?></p>
                </div>
                <!--遮罩-->
                <div id="Layer" style="display:none">
                    <table width="300" border="0" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
                        <tr>
                            <td height="60" align="center" bgcolor="#F5F5F5"><img src="<?php echo __ROOT__?>/resource/admin/images/ajax_x.gif"   width="32" height="32" align="absmiddle" />&nbsp;&nbsp;<span style="color:#FF0000; font-size:12px; font-family:'宋体', verdana" >正在处理数据,请稍等...</span></td>
                        </tr>
                    </table>
                </div>
                <!--遮罩-->
            </div>
        </div>
    </div>

</body>
</html>



