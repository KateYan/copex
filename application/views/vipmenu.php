<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:54 PM
 */
?>
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
<header id="Header"><?php echo $date; ?> 午餐菜单</header>
<div id="Contenter" class="dinner_cont">
    <div class="menu_block">
        <span class="menuD_img"><img src="<?php echo $recomdItem->fpicture; ?>" width="100%" /></span>
        <span class="menuD_summary">
        	<h4><?php echo $recomdItem->fname; ?></h4>
            <p class="menuDP">$<?php echo $recomdItem->fprice; ?></p>
            <span class="dinnerAddPuls">
            	数量
            	<a class="btn_plus" onclick="plusRoom(this)"></a>
                <span class="btn_showNum">1</span>
                <a class="btn_add" onclick="addRoom(this)"></a>
            </span>
        </span>
    </div><!-- end of menu_block -->
    <?php
    foreach($saleItem as $sale){
        echo '<div class="menu_block">';
        echo '<span class="menuD_img"><img src="'.$sale->fpicture.'" width="100%" /></span>';
        echo '<span class="menuD_summary">';
        echo '<h4>'.$sale->fname.'</h4>';
        echo '<p class="menuDP">$'.$sale->fprice.'</p>';
        echo '<span class="dinnerAddPuls">'."数量".'<a class="btn_plus" onclick="plusRoom(this)"></a>';
        echo '<span class="btn_showNum">1</span>';
        echo '<a class="btn_add" onclick="addRoom(this)"></a></span></span></div>';
    }
    ?>
</div>
<footer id="Footer">
    <a class="btn_footer changeArea">更改校区</a>
    <a class="btn_submitOrder" href="goodDinner.html">确认订单</a>
    <div class="clear"></div>
</footer>
</body>
</html>