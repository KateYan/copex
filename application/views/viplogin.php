<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:54 PM
 */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" />
    <meta name="format-detection" content="telephone=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />
    <title>会员登录</title>
    <link href="../../css/masterpage.css" rel="stylesheet" type="text/css" />
    <link href="../../css/viplogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
<strong><img src="../../css/images/memberLogin@2x.png" width="100" /></strong>
    <?php
    $attributes=array('class'=>'login_form','id'=>'viplogin');
    echo form_open('userlogincontroller/vipLogin',$attributes);
    ?>
	<span class="loginTextBox">
    	<input name="phoneNumber" type="tel" class="login_telText" placeholder="请输入手机号"/>
    </span>
    <button form="viplogin" class="btn_login">登录</button>
<div class="login_footer">
    <a class="btn_loginFoot inotMemb" href="../marketcontroller/showDailyMenu">我还不是会员</a>
    <a class="btn_loginFoot whyResMember">为什么要成为会员</a>
</div>
</body>
</html>
