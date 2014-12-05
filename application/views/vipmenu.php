<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:54 PM
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
<!--    <title>午餐菜单</title>-->
<!--    <link href="css/masterpage.css" rel="stylesheet" type="text/css" />-->
<!--    <link href="css/dinner.css" rel="stylesheet" type="text/css" />-->
<!--    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>-->
    <script type="text/javascript">
        $(function(){
            var _W = document.documentElement.clientWidth;
            $(".menuD_img").css("height", parseInt((_W - 18)*0.34*233/222)+"px");
            $(".menuD_summary").css("width", parseInt(_W - 18-(_W - 18)*0.34-20)+"px");
        })
        function plusRoom(thisd) {
            var textV = $(thisd).next("span").html();
            if(textV > 0){
                var valueT = --textV;
                if (textV == 1 || textV < 1) {
                    $(thisd).removeClass("btnselect").addClass("grayBtn").removeAttr("ontouchend");
                    $(thisd).next("span").html("1");
                    $(".pro_num").text("1");
                    return false;
                }
                //$(".pro_num").text(valueT);
                $(thisd).next("span").html(valueT);
            }
        }
        function addRoom(thisd) {
            var textV = $(thisd).prev("span").html();
            var valueT = ++textV;
            if (valueT > 1000) {
                $(thisd).prev("span").html("1000");
                return;
            }
            //$(".pro_num").text(valueT);
            $(thisd).prev("span").html(valueT);
            $(".plusBtn").addClass("btnselect").removeClass("grayBtn").attr("ontouchend", "plusRoom(this)");
        }
    </script>
</head>
<body>
<header id="Header"><?php echo $date; ?>午餐菜单</header>
<div id="Contenter" class="dinner_cont">
    <div class="menu_block">
        <span class="menuD_img"><img src="<?php echo $menuitem['image']; ?>" width="100%" /></span>
        <span class="menuD_summary">
        	<h4><?php echo $menuitem['name']; ?></h4>
            <p class="menuDP">$<?php echo $menuitem['price']; ?></p>
            <span class="dinnerAddPuls">
            	数量
            	<a class="btn_plus" onclick="plusRoom(this)"></a>
                <span class="btn_showNum">1</span>
                <a class="btn_add" onclick="addRoom(this)"></a>
            </span>
        </span>
    </div><!-- end of menu_block -->
    <div class="menu_block">
        <span class="menuD_img"><img src="<?php echo $menuitem['image']; ?>" width="100%" /></span>
        <span class="menuD_summary">
        	<h4><?php echo $menuitem['name']; ?></h4>
            <p class="menuDP">$<?php echo $menuitem['price']; ?></p>
            <span class="dinnerAddPuls">
            	数量
            	<a class="btn_plus" onclick="plusRoom(this)"></a>
                <span class="btn_showNum">1</span>
                <a class="btn_add" onclick="addRoom(this)"></a>
            </span>
        </span>
    </div><!-- end of menu_block -->
    <div class="menu_block">
        <span class="menuD_img"><img src="<?php echo $menuitem['image']; ?>" width="100%" /></span>
        <span class="menuD_summary">
        	<h4><?php echo $menuitem['name']; ?></h4>
            <p class="menuDP">$<?php echo $menuitem['price']; ?></p>
            <span class="dinnerAddPuls">
            	数量
            	<a class="btn_plus" onclick="plusRoom(this)"></a>
                <span class="btn_showNum">1</span>
                <a class="btn_add" onclick="addRoom(this)"></a>
            </span>
        </span>
    </div><!-- end of menu_block -->
</div>
<footer id="Footer">
    <a class="btn_footer changeArea">更改校区</a>
    <a class="btn_submitOrder" href="goodDinner.html">确认订单</a>
    <div class="clear"></div>
</footer>
</body>
</html>