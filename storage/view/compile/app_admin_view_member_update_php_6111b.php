<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo __ROOT__?>/resource/admin/css/style_admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo __ROOT__?>/resource/admin/css/select2css.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo __ROOT__?>/resource/admin/js/submit.js"></script>
    <script type="text/javascript" src="<?php echo __ROOT__?>/resource/admin/js/jquery-1.7.1.min.js"></script>
    <title>会员管理中心</title>
    <script>

        function check(){
            if ($('#password').val()!="") {
                if ($('#password').val().length<6) {
                    window.alert("密码不能小于6个字符.");
                    $('#password').focus();
                    return false;
                }
            }
            if ($('#Last_Name').val()=="") {
                window.alert("请输入真实姓名.");
                $('#Last_Name').focus();
                return false;
            }
            if ($('#Contact_Tel').value=="") {
                window.alert("请输入手机/电话.");
                $('#Contact_Tel').focus();
                return false;
            }
            if ($('#E_Mail').value=="") {
                window.alert("请输入电子邮箱.");
                $('#E_Mail').focus();
                return false;
            }



            $('#sub').submit();

        }
    </script>
</head>
<body style="background:url(__PUBLIC__/images/r_bj.jpg) repeat; height:1200px;">
<div class="height10"></div>
<div id="biaoge">
    <div class="title"><span></span><H2>会员信息修改</H2></div>
    <div class="box">

        <form id='sub' name='sub' action='<?php echo U("admin/member/doupdate")?>' method="post">

            <table width="100%" cellpadding="0" cellspacing="0" border="0" class="ymxx">
                <tr>
                    <td><table width="97%" cellpadding="0" cellspacing="1" border="0" align="center" bgcolor="#F0F0F0" style="margin:20px 0px 0px 0px;">
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">登录名：</td>
                                <td align="left" style="padding-left:10px;"><?php echo $data['user_name']?>
                                    <input type='hidden' name='id' value="<?php echo $data['id']?>">
                                </td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">密码：</td>
                                <td align="left" style="padding-left:10px;"><input name="user_password" type="password" id='password' class="txt5" />&nbsp;&nbsp;<span class="orange">不修改密码，请留空</span></td>
                            </tr>


                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">会员等级：</td>
                                <td align="left" style="padding-left:10px;">
                                    <select name='member_level_id'>
                                                <?php
        if (empty($level)) {
            echo '没有数据';
        }else{
            //初始化
            $_name= substr('$m',1);
            $hd['list'][$_name]['first']=false;
            $hd['list'][$_name]['last'] =false;
            $hd['list'][$_name]['index']=0;
            $hd['list'][$_name]['total']=0;
            $id=0;$key=0;$_tmp=$level;
            for($index=0;$index<count($level);$index++){
                $m=$_tmp[$key];$key +=1; 
                $hd['list'][$_name]['first'] = $index==0;
                $hd['list'][$_name]['index'] = ++$id;
				$hd['list'][$_name]['last']  = $id>=100 || !isset($_tmp[$key]);
            ?>

                                            <option value="<?php echo $m['id']?>" <?php if($m['id']==$data['member_level_id']){?>
                selected
               <?php }?> > <?php echo $m['member_level']?></option>

                                        <?php 
					if($hd['list'][$_name]['last']){break;}
				}}?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">真实姓名：</td>
                                <td align="left" style="padding-left:10px;"><input name="last_name" type="text" class="txt5" value="<?php echo $data['last_name']?>" id='Last_Name'/></td>
                            </tr>

                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">联系手机：</td>
                                <td align="left" style="padding-left:10px;"><input name="Contact_Tel" type="text" class="txt5" value="<?php echo $data['contact_tel']?>" onKeyUp="value=value.replace(/[^\d]/g,'')" id='Contact_Tel'/></td>
                            </tr>
                            <tr class="bbj33" bgcolor="#FFFFFF">
                                <td width="15%" align="right" bgcolor="#fcfcfc">电子邮箱：</td>
                                <td align="left" style="padding-left:10px;"><input name="e_mail" type="text" class="txt5" value='<?php echo $data["e_mail"]?>' id='E_Mail'/></td>
                            </tr>
    </div>
    </td>
    </tr>

    <tr class="bbj33" bgcolor="#FFFFFF">
        <td width="15%" align="right" bgcolor="#fcfcfc">QQ账号绑定：</td>
        <td align="left" style="padding-left:10px;"><input name="openqq_id" type="checkbox" value="<?php echo $data['openqq_id']?>" <?php if($data['openqq_id']==''){?>
                disabled<?php }else{?>checked
               <?php }?> />&nbsp;&nbsp;绑定QQ号</td>
    </tr>

    <tr class="bbj33" bgcolor="#FFFFFF">
        <td width="15%" align="right" bgcolor="#fcfcfc">余额：</td>
        <td align="left" style="padding-left:10px;">￥<?php echo $data['money_number']?> 元</td>
    </tr>
    <tr class="bbj33" bgcolor="#FFFFFF">
        <td width="15%" align="right" bgcolor="#fcfcfc">总共消费：</td>
        <td align="left" style="padding-left:10px;">￥<?php echo $data['money_consumption']?> 元</td>
    </tr>
    <tr class="bbj33" bgcolor="#FFFFFF">
        <td width="15%" align="right" bgcolor="#fcfcfc">总共充值：</td>
        <td align="left" style="padding-left:10px;">￥<?php echo $data['money_total']?> 元</td>
    </tr>

    <tr class="bbj33" bgcolor="#FFFFFF">
        <td width="15%" align="right" bgcolor="#fcfcfc">上次登录IP地址：</td>
        <td align="left" style="padding-left:10px;"><?php echo $data['user_to_ip']?></td>
    </tr>
    <tr class="bbj33" bgcolor="#FFFFFF">
        <td width="15%" align="right" bgcolor="#fcfcfc">上次登录时间：</td>
        <td align="left" style="padding-left:10px;"><?php echo $data['user_to_time']?></td>
    </tr>
    <input type='hidden' name='id' value="<?php echo $data['id']?>">

    </table>
    </td>
    </tr>
    <tr>
        <td style="padding:15px 0px 15px 0;" align="center"><input id="xiugai" onclick="check();" type="button"><input id="fanhui" onclick="cancel('__APP__/admin/member/m_index')" type="button"></td>
    </tr>
    </table>
    </form>

</div>
</div>
</body>
</html>