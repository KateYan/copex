<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/10/2014
 * Time: 12:11 PM
 */
?>
<!--<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">-->
<!--<html>-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta http-equiv="Cache-control" />-->
<!--    <meta name="format-detection" content="telephone=no" />-->
<!--    <meta content="yes" name="apple-mobile-web-app-capable" />-->
<!--    <meta content="black" name="apple-mobile-web-app-status-bar-style" />-->
<!--    <meta content="telephone=no" name="format-detection" />-->
<!--    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />-->
<!--    <title>更改密码</title>-->
<!--    <link href="--><?php //echo base_url();?><!--css/masterpage.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="--><?php //echo base_url();?><!--css/viplogin.css" rel="stylesheet" type="text/css" />-->
</head>
<body>
<form class="resetPSW_form" method="post" action="<?php echo base_url();?>index.php/userlogincontroller/changePassword">
	<span class="loginTextBox resetPSW useInput">
        <?php
        echo '<input name="phoneNumber" type="tel" class="login_telText" placeholder="';
        if(isset($wrongphone)){
            echo $wrongphone;
        }else{
            echo "手机号";
        }
        echo '" required />';
        ?>
    </span>
    <span class="loginTextBox resetPSW">
        <?php
        echo '<input name="oldPassword" type="password" class="login_telText" placeholder="';
        if(isset($wrongpw)){
            echo $wrongpw;
        }else{
            echo "旧密码";
        }
        echo '" required />';
        ?>
    </span>
    <span class="loginTextBox resetPSW">
          <?php
          echo '<input name="newPassword" type="password" class="login_telText" placeholder="';
          if(isset($samepw)){
              echo $samepw;
          }else{
              echo "新密码";
          }
          echo '" required />';
          ?>
    </span>
    <div class="btn_resetOrder">
        <a class="btn_submitOrder btn_prevPage" href="../marketcontroller/showSideDish">回到上页</a>
        <button style="border:none;" class="btn_submitOrder btn_sumbitRet">提交修改</button>
        <div class="clear"></div>
    </div>
</form>
</body>
</html>
