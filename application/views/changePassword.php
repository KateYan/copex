<link href="/copex/css/viplogin.css" rel="stylesheet" type="text/css" />
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-62513157-2', 'auto');
    ga('send', 'pageview');

</script>
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
        <?php
        if(isset($eMsg)){
            echo '<p style="color:red;">';
            echo $eMsg;
            echo '</p>';
        }else{
            echo '<p>';
            echo "请输入6-10位密码，组合只可包含数字/字母/下划线/破折号";
            echo '</p>';
        };
        ?>
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
