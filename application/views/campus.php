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
    <meta name="screen-orientation" content="portrait" />
    <title>选择你所在的校区</title>
    <link href="/copex/css/campus.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/copex/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">
        $(function(){
            setTimeout(function(){$(".logo_area").animate({"opacity": "1"})},1);
            setTimeout(function(){$(".select_Campus").animate({"opacity": "1"})},500);
            setTimeout(function(){$(".btn_loginArea").animate({"opacity": "1"})},1000);
            $(".select_Campus").bind("click", function(){
                $(".campus_list").show();
            });
            $(".campus_list li").bind("click", function(){
                $(this).parent().siblings().children("li").removeClass("selectLi");
                $(this).addClass("selectLi");
                $("#Campus_id").val($(this).html());
                $(".campus_list").hide();
            });
        });
//        $(function(){
//            $(".select_Campus").live("click", function(){
//                $(".campus_list").show();
//            });
//            $(".campus_list li").live("click", function(){
//                $(this).addClass("selectLi").siblings().removeClass("selectLi");
//                $("#Campus_id").val($(this).html());
//                $(".campus_list").hide();
//            });
//        });

    </script>
</head>
<body>
<div class="loginBox">
    <div class="logo_area">
        <img src="/copex/css/images/newyear_logo.gif" width="50%">
        <p>校园美味 自成一派</p>
    </div>
    <span class="select_Campus">
    	<input type="tel" class="campus" placeholder=" 请选择校区" disabled="disabled" id="Campus_id" />
    </span>
    <p style="color:red;"><?php echo (isset($eMsg))? $eMsg : '';  ?></p>

    <!--    <ul class="campus_list">-->
    <?php
    $attributes = array('id'=>'choose_campus');
    echo form_open('userlogincontroller/setUser',$attributes);
    ?>
        <ul class="campus_list">
            <?php
            foreach ($result as $campus) {
                echo '<input type="radio" name="cid" id="'.$campus->cid.'" value="'.$campus->cid.'" style="display:none;">';
                echo '<label for="'.$campus->cid.'"><li>'."  ";
                echo $campus->cname;
                echo '</li></label>';
            }
            ?>
        </ul>
        <div class="btn_loginArea">
            <button style="border: none;" class="btn_login">去看看有什么好吃的</button>
        </div>
    <?php
    echo form_close();
    ?>

    <?php
    if(!isset($_SESSION['vipid'])){
        echo '<div class="btn_loginArea">';
        echo '<button onclick="window.location =';
        echo "'/copex/index.php/userlogincontroller/showVipLogin';";
        echo '" class="btn_login" style="border: none;">';
        echo "会员登录";
        echo '</button></div>';
    }
    ?>


</div>
</body>
</html>
