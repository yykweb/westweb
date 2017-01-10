<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo __ROOT__?>/resource/admin/css/style_admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo __ROOT__?>/resource/admin/css/select2css.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo __ROOT__?>/resource/admin/js/submit.js"></script>
    <script type="text/javascript" src="<?php echo __ROOT__?>/resource/admin/js/select.js"></script>
    <title>会员管理中心</title>
    <script>
        function check(){
            if ($('User_Name').value=="") {
                window.alert("用户名字母开头且在3到16位之间!.");
                $('User_Name').focus();
                return false;
            }
            if ($('User_Name').value.length < 3) {
                window.alert("密码字母开头且在6到16位之间!.");
                $('User_Name').focus();
                return false;
            }
            if ($('password').value=="") {
                window.alert("密码字母开头且在6到16位之间!");
                $('password').focus();
                return false;
            }
            if ($('password').value.length<6) {
                window.alert("密码字母开头且在6到16位之间!");
                $('password').focus();
                return false;
            }
            if ($('rpassword').value != $('password').value) {
                window.alert("密码和确认密码不一致.");
                $('rpassword').focus();
                return false;
            }

            if ($('Last_Name').value=="") {
                window.alert("请输入真实姓名.");
                $('Last_Name').focus();
                return false;
            }
            if ($('Contact_Tel').value=="") {
                window.alert("请输入手机/电话.");
                $('Contact_Tel').focus();
                return false;
            }
            if ($('E_Mail').value=="") {
                window.alert("请输入正确电子邮箱.");
                $('E_Mail').focus();
                return false;
            }

            $('sub').submit();
        }
    </script>
</head>
<body style="background:url(__PUBLIC__/images/r_bj.jpg) repeat; height:1200px;">
<div class="height10"></div>
<div id="biaoge">
    <div class="title"><span></span><H2>添加会员</H2></div>
    <div class="box">

        <form id='sub' action='<?php echo U("admin/member/doadd")?>' method="post">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ymxx">
                <tr>
                    <td><table width="97%" cellpadding="0" cellspacing="1" border="0" align="center" bgcolor="#F0F0F0" style="margin:20px 0px 0px 0px;">
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">登录名：</td>
                                <td align="left" style="padding-left:10px;"><input name="user_name" id='User_Name' type="text" class="txt5" onblur="check_pass('user_name','','<?php echo U("admin/member/ajax_user")?>','check_user');"/>&nbsp;&nbsp;<span id='check_user'></span></td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">密码：</td>
                                <td align="left" style="padding-left:10px;"><input name="user_password" id="password" type="password" class="txt5" /></td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">确认密码：</td>
                                <td align="left" style="padding-left:10px;"><input name="rpassword" id='rpassword' type="password" class="txt5" /></td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">会员等级：</td>
                                <td align="left" style="padding-left:10px;">
                                    <select name='member_level_id' id='Member_Level_ID'>
                                                <?php
        if (empty($level)) {
            echo '';
        }else{
            //初始化
            $_name= substr('$l',1);
            $hd['list'][$_name]['first']=false;
            $hd['list'][$_name]['last'] =false;
            $hd['list'][$_name]['index']=0;
            $hd['list'][$_name]['total']=0;
            $id=0;$key=0;$_tmp=$level;
            for($index=0;$index<count($level);$index++){
                $l=$_tmp[$key];$key +=1; 
                $hd['list'][$_name]['first'] = $index==0;
                $hd['list'][$_name]['index'] = ++$id;
				$hd['list'][$_name]['last']  = $id>=100 || !isset($_tmp[$key]);
            ?>
                                            <option value="{$l['id']}"><?php echo $l['member_level']?></option>
                                        <?php 
					if($hd['list'][$_name]['last']){break;}
				}}?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">真实姓名：</td>
                                <td align="left" style="padding-left:10px;"><input name="last_name" ID='Last_Name' type="text" class="txt5" /></td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">手机 / 电话：</td>
                                <td align="left" style="padding-left:10px;"><input name="contact_tel" id="Contact_Tel" type="text" class="txt5" onKeyUp="value=value.replace(/[^\d]/g,'')"/></td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">电子邮箱：</td>
                                <td align="left" style="padding-left:10px;"><input name="e_mail" type="text" id="E_Mail" class="txt5" /></td>
                            </tr>

    </div>
    </td>
    </tr>

    </table>

    </td>
    </tr>
    <tr>
        <td style="padding:15px 0px 15px 0;" align="center"><input id="add" onclick="check();" type="button"><input id="fanhui" onclick="cancel('__APP__/admin/member/m_index')" type="button"></td>
    </tr>
    </table>

    </form>


</div>
</div>
</body>
</html>