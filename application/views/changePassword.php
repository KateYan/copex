<link href="/copex/css/viplogin.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php
    $attributes = array('class'=>'resetPSW_form','id'=>'change_password');
    echo form_open('userlogincontroller/changePassword',$attributes);
    ?>
	<span class="loginTextBox resetPSW useInput">
        <input name="phoneNumber" type="tel" class="login_telText" placeholder="手机号" required />
    </span>
    <span class="loginTextBox resetPSW">
        <input name="oldPassword" type="password" class="login_telText" placeholder="旧密码" required />
    </span>
    <span class="loginTextBox resetPSW">
        <input name="newPassword" type="password" class="login_telText" placeholder="新密码" required />
    </span>
    <p style="color:red;"><?php echo (isset($eMsg))? $eMsg : '';  ?></p>
    <div class="btn_resetOrder">
        <?php
        $attributes = array('class'=>'btn_submitOrder btn_prevPage');
        echo anchor('marketcontroller/showSideDish','回到上页',$attributes)
        ?>
        <button style="border:none;" class="btn_submitOrder btn_sumbitRet">提交修改</button>
        <div class="clear"></div>
    </div>
<?php
echo form_close();
?>
</body>
</html>
