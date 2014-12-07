<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/6/2014
 * Time: 11:25 PM
 */
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" />
    <meta name="format-detection" content="telephone=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />
    <title>login</title>
    <link href="../../css/login.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".select_Campus").live("click", function(){
                $(".campus_list").show();
            });
            $(".campus_list li").live("click", function(){
                $(this).addClass("selectLi").siblings().removeClass("selectLi");
                $("#Campus_id").val($(this).html());
                $(".campus_list").hide();
            });
        });
    </script>
</head>
<body>
<div class="loginBox">
    <div class="logo_area">
        <img src="../../css/images/logo.gif" width="50%">
        <p>校园美味 自成一派</p>
    </div>
    <span class="select_Campus">
    	<input type="tel" class="campus" placeholder="请选择校区" disabled="disabled" id="Campus_id" />
    </span>

    <!--    <ul class="campus_list">-->
    <?php
    $attributes=array('class'=>'formcontrol','id'=>'campus');
    echo form_open('userlogincontroller/setUser',$attributes);

    echo '<ul class="campus_list">';

    foreach ($result as $campus) {
        echo '<li><span><input type="radio" name="cid" value="'.$campus->cid.'">';
        echo $campus->cname;
        echo '</span></li>';
    }

    echo '</ul>';
    echo '<div class="btn_loginArea"><button class="btn_login"">'."去看看有什么好吃的".'</button></div>';
    ?>

</div>
</body>
</html>