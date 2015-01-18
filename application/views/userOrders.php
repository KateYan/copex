<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/30/2014
 * Time: 2:26 PM
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
</script>
</head>
<body>
<header id="Header"><?php echo $date; ?> 今天我的订单</header>

<div id="Contenter" class="dinner_cont">
    <?php
    if(isset($orders)){
        foreach($orders as $order){
            echo '<div class="menu_block">';
            echo '<div class="menuD_img"><img src="/copex/upload/'.$order->fpicture.'" width="100%" /></div>';
            echo '<div class="menuD_summary">';
            echo '<h4 style="margin-bottom: 5px;">'."订单号：".$order->oid.'</h4>';

            echo '<h4 style="margin-bottom: 5px;">'."主食：".$order->fname.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."数量：".$order->amount.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."单价：$ ".$order->price.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."税费：$ ".$order->tax.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."总价：$ ".$order->totalcost.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."下单时间： ".$order->odate.'</h4>';

            if($order->oispaid==0){
                echo '<h4 style="margin-bottom: 5px;">'."付款状态：未付款 ".'</h4>';
            }else{
                echo '<h4 style="margin-bottom: 5px;">'."付款状态：已付款 ".'</h4>';
            }

            if($order->ostatus==0){
                echo '<h4 style="margin-bottom: 5px;">'."取餐状态：未取餐 ".'</h4>';
            }else{
                echo '<h4 style="margin-bottom: 5px;">'."取餐状态：已取餐 ".'</h4>';
            }
            echo '<h4 style="margin-bottom: 5px;">'."取餐日期：".$order->fordate.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."取餐校区：".$order->cname.'</h4>';
            echo '<h4 style="margin-bottom: 5px;">'."取餐地址：".$order->caddr.'</h4>';
            echo '</div></div>';
        }
    }else{
        echo '<div class="menu_block">';
        echo "您今天还没有下单哦";
        echo '</div>';
    }
    ?>
    <a href="userstatuscontroller/checkUserStatus" class="btn_submitOrder btn_nowOrder" style="border:none;width: 100%;margin-top: 20px;">去点餐</a>
</div>

</body>
</html>