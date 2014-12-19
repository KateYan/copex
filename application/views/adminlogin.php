<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/18/2014
 * Time: 7:49 PM
 */
?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
<head>
    <title>Copex | 后台管理系统登陆</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" media="screen" href="/copex/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" media="screen" href="/copex/bootstrap/css/bootstrap-theme.min.css">

    <!-- Bootstrap Admin Theme -->
    <link rel="stylesheet" media="screen" href="/copex/bootstrap/css/bootstrap-admin-theme.css">

    <!-- Custom styles -->
    <style type="text/css">
        .alert{
            margin: 0 auto 20px;
        }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/copex/bootstrap/js/html5shiv.js"></script>
    <script type="text/javascript" src="/copex/bootstrap/js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bootstrap-admin-without-padding">
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert" href="#">&times;</a>
                点击回车或“提交”
            </div>
            <?php
            $attributes = array('class'=>'bootstrap-admin-login-form');
            echo form_open('admincontroller/adminLogin',$attributes);
            ?>
                <h1>Copex 管理员登陆</h1>
                <div class="form-group">
                    <input class="form-control" type="text" name="username" placeholder="管理员用户名" >
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="password" placeholder="管理员密码" >
                    <p style="color:red;"><?php echo (isset($eMsg))? $eMsg : '';  ?></p>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember_me">
                        记住我
                    </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit">提交</button>
            <?php
            echo form_close();
            ?>
        </div>
    </div>
</div>

<script type="text/javascript" src="/copex/bootstrap/js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(function() {
        // Setting focus
        $('input[name="username"]').focus();

        // Setting width of the alert box
        var alert = $('.alert');
        var formWidth = $('.bootstrap-admin-login-form').innerWidth();
        var alertPadding = parseInt($('.alert').css('padding'));

        if (isNaN(alertPadding)) {
            alertPadding = parseInt($(alert).css('padding-left'));
        }

        $('.alert').width(formWidth - 2 * alertPadding);
    });
</script>
</body>
</html>
