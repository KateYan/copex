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

        var startTime = $('#timestart').val().split(":"), endTime = $('#timeend').val().split(":");
        var s = new Date(), e = new Date(), n = new Date();

        s.setHours(startTime[0]);
        s.setMinutes(startTime[1]);
        s.setSeconds(startTime[2]);


        e.setHours((endTime[0] <=startTime[0])? (endTime[0] + 24): endTime[0]);
        e.setMinutes(endTime[1]);
        e.setSeconds(endTime[2]);

            $("form#menuItem").submit(function(){
                if(!((s<n)&&(n<e))){
                    $('.layer').show();
                    return false;
                }

            });


    })
    </script>
</head>

<body>
<header id="main_title"><?php echo $date; ?> 午餐菜单</header>
<?php
    $attributes = array('class'=>'formcontrol', 'id'=>'menuItem');
    echo form_open('marketcontroller/orderGenerate',$attributes);

?>
<input type="hidden" id="timestart" value="<?php echo $orderStart ?>" >
<input type="hidden" id="timeend" value="<?php echo $orderEnd ?>" >
<div class="manaRecommends">
    <h3>店长推荐</h3>
    <?php
    /*
     * add food's id sending element-><input>
     * and add a label for it, so once the input is checked
     * the border of label will pop out to high light which food
     * the user just chose
     */
    echo '<input type="radio" id="recomdItem" name="fid" value="'.$recomdItem->fid.'">';
    echo '<label for="recomdItem">';
    echo '<div class="manaRecom_menu">';
    echo ' <img src="../../upload/'.$recomdItem->fpicture.'.jpg" width="100%" >';
    ?>
        <ul>
            <li><?php echo $recomdItem->fname;?><i class="borderWidth"></i></li>
            <li>$<?php echo $recomdItem->fprice;?></li>
        </ul>
    </div>
    </label>
</div>
<div class="tdySales">
    <h3>今日特价</h3>
    <div class="tdySal_menu">
        <?php
            foreach($saleItem as $sale){
                /* add food's id sending element-><input>
                 * and add a label for it, so once the input is checked
                 * the border of label will pop out to high light which food
                 * the user just chose
                 */
                echo '<div class="tdySal_menu_item"><input type="radio" id="'.$sale->fid.'" name="fid" value="'.$sale->fid.'">';
                echo '<label class="tdyS_m_block" for="'.$sale->fid.'">';
                echo '<span class="tdyS_m_img">';
                echo '<img src="../../upload/';
                echo $sale->fpicture.'.jpg" width="100%">';
                echo '</span>';
                echo '<span class="menu_title">'.$sale->fname." $".$sale->fprice.'</span>';
                echo '</label> </div>';

            }
        ?>
        <div class="clear"></div>
    </div>
</div>
<div class="dSales_btnTo">
    <a class="btn_footer moreDinner" href="../userlogincontroller/showVipLogin">想多选？点这里</a>
    <a href="../userlogincontroller/loadCampus" class="btn_footer notInUTSC">我不在<?php echo $cname; ?></a>
    <div class="clear"></div>
</div>
<footer id="Footer">
    <div class="dinnerS_fMain">
        <input type="tel" class="telephone" name="uphone" placeholder="<?php if(isset($_SESSION['uphone'])){echo $_SESSION['uphone']; }else{echo "请输入手机号";}?>" value="<?php echo $uphone; ?>" required/>
        <button class="btn_submitOrder btn_nowOrder" id="submit_form" style="border:none;">立刻下单</button>
    </div>
</footer>
</form>
<div class="layer">
    <div class="black_layer"></div>
    <div class="layer_summary">
        <p>对不起，已经超过<span class="sorry">0:00了哦，你可以</span></p>
        <ul>
            <li>
                <a class="btn_again" href="../userlogincontroller/showVipLogin">A加入会员延长订餐时间</a>
            </li>
            <li>
                <a class="btn_again" href="showDailyMenu">B明天中午12:00后再订餐</a>
            </li>
        </ul>
    </div>
</div>
</body>
</html>

<?php
