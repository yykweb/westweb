<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="<?php echo __ROOT__?>/resource/admin/css/style_admin.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo __ROOT__?>/resource/admin/css/css.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo __ROOT__?>/resource/admin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo __ROOT__?>/resource/admin/js/submit.js"></script>
    <title>主机管理系统|管理平台</title>
    <script>
        $(function(){
            $("#chkall").click(function(){
                if(this.checked){
                    $("input[name='id[]']").attr('checked', true)
                }else{
                    $("input[name='id[]']").attr('checked', false)
                }
            });

            $('#buttonsend').click(function(){

                if($('#select').val()==''){
                    window.alert('请选择查看方式.');
                    $('#select').focus();
                    return false;
                }

                if($('#content').val()==''){
                    window.alert('请输入搜索内容.');
                    $('#content').focus();
                    return false;
                }
            })
        });

    </script>
</head>
<body style="background:url(__PUBLIC__/images/r_bj.jpg) repeat;">
<div class="height10"></div>
<div id="biaoge">
    <div class="title"><span></span><H2>会员管理</H2></div>
    <div class="box">
        <form action='<?php echo U("admin/member/index")?>' method="get">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="ymxx">
                <tr class="bbj44">
                    <td colspan="10">
                        <table width="380" border="0" cellspacing="0" cellpadding="0" align="left">
                            <tr>
                                <td width="90" height="25" valign="middle" class="text_hs" scope="col">&nbsp;搜索：</td>
                                <td width="70" valign="middle" scope="col"><select name="search" class="List_select" id="select">
                                        <option value="">请选择方式</option>
                                        <option value="user_name" >登录名</option>
                                        <option value="last_name" >真实姓名</option>
                                        <option value="contact_tel" >联系手机</option>
                                        <option value="e_mail" >电子邮箱</option>
                                    </select></td>
                                <td width="151" valign="middle" scope="col">
                                    <input name="content" type="text" class="txt" id="content" size="20">
                                </td>
                                <td width="51" scope="col">
                                    <input  type="submit" class="btn1" id="buttonsend" value="">
                                </td>
                            </tr>
                        </table>
                    </td>
        </form>


        </tr>
        <tr class="bbj3">
            <td width="6%" class="alltext1_note"><input name="chkall" type="checkbox" class="checkbox" id="chkall" value="on"></td>
            <td width="20%" class="alltext1_note"><B>登录名</B></td>
            <td width="10%" class="alltext1_note"><B>会员等级</B></td>
            <td width="10%" class="alltext1_note"><B>真实姓名</B></td>
            <td width="20%" class="alltext1_note"><B>联系电话</B></td>
            <td width="12%" class="alltext1_note"><b>余额 &nbsp;<a href='<?php echo U("admin/member/index")?>/action/desc/by/money_number' name="降序" title="降序"> <font color='blue'>∨ </font></a><a href='<?php echo U("admin/member/index")?>/action/asc/by/money_number' name="升序" title="升序"> <font color='blue'>∧ </font></a></b></td>
            <td width="8%" class="alltext1_note"><B>已消费 &nbsp;<a href='<?php echo U("admin/member/index")?>/action/desc/by/money_consumption' name="降序" title="降序"> <font color='blue'>∨ </font></a><a href='<?php echo U("admin/member/index")?>/action/asc/by/money_consumption' name="升序" title="升序"> <font color='blue'>∧ </font></a></B></td>
            <td width="8%" class="alltext1_note"><B>总充值 &nbsp;<a href='<?php echo U("admin/member/index")?>/action/desc/by/money_total' name="降序" title="降序"> <font color='blue'>∨ </font></a><a href='<?php echo U("admin/member/index")?>/action/asc/by/money_total' name="升序" title="升序"> <font color='blue'>∧ </font></a></B></td>
            <td width="6%" class="alltext1_note"><B>操作</B></td>
        </tr>



        <form id='sub' name='sub' action='<?php echo U("admin/member/delete")?>' method="post">
                    <?php
        if (empty($member)) {
            echo '没有数据';
        }else{
            //初始化
            $_name= substr('$v',1);
            $hd['list'][$_name]['first']=false;
            $hd['list'][$_name]['last'] =false;
            $hd['list'][$_name]['index']=0;
            $hd['list'][$_name]['total']=0;
            $id=0;$key=0;$_tmp=$member;
            for($index=0;$index<count($member);$index++){
                $v=$_tmp[$key];$key +=1; 
                $hd['list'][$_name]['first'] = $index==0;
                $hd['list'][$_name]['index'] = ++$id;
				$hd['list'][$_name]['last']  = $id>=10 || !isset($_tmp[$key]);
            ?>
                <tr class="bbj3">
                    <td width="6%" class="alltext1_note">
                        <input name="id[]" type="checkbox" class="checkbox" id="chkall" value="<?php echo $v['id']?>">
                    </td>
                    <td width="20%" class="alltext1_note"><a href='<?php echo U("user/admin_user_login")?>/user/<?php echo $v["user_name"]?>' title="打开用户面板" name="打开用户面板" target="_blank"><?php echo $v['user_name']?></a></td>
                    <td width="10%" class="alltext1_note"><?php echo $v['member_level']?></td>
                    <td width="10%" class="alltext1_note"><?php echo $v['last_name']?></td>
                    <td width="20%" class="alltext1_note"><?php echo $v['contact_tel']?></td>
                    <td width="12%" class="alltext1_note"><?php echo $v['money_number']?></td>
                    <td width="8%" class="alltext1_note"><?php echo $v['money_consumption']?></td>
                    <td width="8%" class="alltext1_note"><?php echo $v['money_total']?></td>
                    <td width="6%" class="alltext1_note"><a href='<?php echo U("admin/member/update")?>&user_name=<?php echo $v["user_name"]?>'>编辑</td>
                </tr>
            <?php 
					if($hd['list'][$_name]['last']){break;}
				}}?>

            <tr class="bbj5">
                <td colspan="10">
                    <div class="anniu">
                        <ul>
                            <li><a href="<?php echo U('admin/member/add')?>">添加记录</a></li>
                            <li><a href="javascript:sub()" onclick="return yesno('确认要删除！');">删除所选记录</a></li>
                        </ul>
                    </div>
                    <div class="pagination">
                        <ul>

        </form>
        <script>
            function sub(){
                document.sub.submit();
            }
        </script>


        <?php echo $page?>

        </ul>
    </div>
    </td>
    </tr>
    </table>
</div>
</div>
</body>
</html>
