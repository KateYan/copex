<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:51 PM
 */
?>
<script type="text/javascript">
        $(function(){
            var _W = document.documentElement.clientWidth;
            $(".manaRecom_menu").css("height", parseInt((_W - 18)*256/606)+"px");
            $(".tdyS_m_block").css("height", parseInt((_W - 18)*0.46*317/266)+"px");

        })
        function choosefood(id){
            id.style.padding="5px";
            id.style.border="2px solid #3c3c3c";
            var para=document.createElement("input");
            para.name="fid";
            para.value="<?php echo $recomdItem->fid?>";
            para.style.display="none";
            id.appendChild(para);
        }

    </script>
</head>
<body>
<header id="Header"><?php echo $date; ?> 午餐菜单</header>
<?php
    $attributes = array('class'=>'formcontrol', 'id'=>'menuItem');
    echo form_open('marketcontroller/orderGenerate',$attributes);

?>
<div class="manaRecommends">

    <h3>店长推荐</h3>
    <div onclick=choosefood(this) class="manaRecom_menu" id="recomdItem" >

        <?php
            $foodid=$recomdItem->fid;
            echo '<img src="';
            echo $recomdItem->fpicture;
            echo '" width="100%" height="100%"/>';
        ?>
        <ul>
            <li><?php echo $recomdItem->fname;?><i class="borderWidth"></i></li>
            <li>$<?php echo $recomdItem->fprice;?></li>
        </ul>
    </div>
</div>
<div class="tdySales">
    <h3>今日6.99特价</h3>
    <div class="tdySal_menu">
        <?php
            foreach($saleItem as $sale){
                echo '<div onclick=choosefood(this) class="tdyS_m_block">';

                echo '<span  class="tdyS_m_img">';
                echo '<img src="';
                echo $sale->fpicture.'" width="100%" height="100%" />';
                echo '<span class="menu_title">'.$sale->fname.'</span>';
                echo '</span>';
                echo '</div>';
            }
        ?>
        <div class="clear"></div>
    </div>
</div>
<div class="dSales_btnTo">
    <a class="btn_footer moreDinner" href="dinner.html">想多选？点这里</a>
    <a href="../userlogincontroller/loadCampus" class="btn_footer notInUTSC">我不在UTSC</a>
    <div class="clear"></div>
</div>
<footer id="Footer">
    <div class="dinnerS_fMain">
        <input type="tel" class="telephone" name="uphone" placeholder="输入手机号" value="<?php echo $uphone; ?>" />
        <button class="btn_submitOrder btn_nowOrder">立刻下单</button>
    </div>
</footer>
<div class="layer">
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p>对不起，已经超过<span class="sorry">0:00了哦，你可以</span></p>
        <ul>
            <li><a class="btn_again">A加入会员延长订餐时间</a></li>
            <li><a class="btn_again">B明天中午12:00后再订餐</a></li>
        </ul>
    </div>
</div>
</body>
</html>

<?php
