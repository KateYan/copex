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
        function minRoom(thisd) {
            var textV = $(thisd).next("span").children('input').val();
            if(textV > 0){
                var valueT = --textV;
                if (textV <= 0) {
                    $(thisd).next("span").children('input').val('0');
                    return false;
                }
                $(thisd).next("span").children('input').val(valueT);
            }
        }
        function addRoom(thisd) {
            var textV = $(thisd).prev("span").children('input').val();
            var valueT = ++textV;
            if (valueT > 50) {
                $(thisd).prev("span").children('input').val(50);
                return false;
            }
            $(thisd).prev("span").children('input').val(valueT);
        }
    </script>
</head>
<body>
<header id="Header"><?php echo $date; ?> 午餐菜单</header>
<div id="Contenter" class="dinner_cont">

    <?php
    $attributes = array('class'=>'formcontrol', 'id'=>'vipmenuitem');
    echo form_open('marketcontroller/showSideDish',$attributes);
    ?>


    <?php
    foreach($menu_items as $key => $sale){
        $id = $key+1;
        echo "<input type='hidden' name='fid$id' value='".$sale->fid."'>";
        echo '<div class="menu_block">';
        echo '<div class="menuD_img"><img src="../../upload/'.$sale->fpicture.'.jpg" width="100%" /></div>';
        echo '<div class="menuD_summary">';
        echo '<h4>'.$sale->fname.'</h4>';
        echo '<p class="menuDP">$'.$sale->fprice.'</p>';
        echo '<span class="dinnerAddPuls">'."数量".'<a class="btn_plus" onclick="minRoom(this)"></a>';
        echo '<span class="btn_showNum">';
        echo "<input type='text' name='amt$id' value='2' readonly='readonly'/></span>";
        echo '<a class="btn_add" onclick="addRoom(this)"></a></span></div></div>';
    }
    ?>

</div>
<footer id="Footer">
    <a href="../userlogincontroller/loadCampus" class="btn_footer changeArea">更改校区</a>
    <button class="btn_submitOrder btn_nowOrder" style="border:none;">确认订单</button>
    <!-- <a class="btn_submitOrder" href="showSideDish">确认订单</a> -->
    <div class="clear"></div>
</footer>
</body>
</html>