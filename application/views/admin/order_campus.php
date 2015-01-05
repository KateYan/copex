<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 12:07 AM
 */
?>

    <!-- Datatables -->
    <link rel="stylesheet" media="screen" href="/copex/bootstrap/css/DT_bootstrap.css">
    <link rel="stylesheet" media="print" href="/copex/bootstrap/css/DT_bootstrap.css">
<script>
    function printOrder(){
//        var elems1 = document.getElementsByClassName('anoPrint');
//        for(var i = 0; i < elems1.length; i++) {
//            elems1[i].style.display = "none";
//        }
//        var elems2 = document.getElementsByClassName('print');
//        for(var i = 0; i < elems2.length; i++) {
//            elems2[i].style.display = "table-cell";
//        }
        window.print()
    }
</script>
<style type="text/css" media="screen">
    .print{display:none;}
</style>
<style type="text/css" media="print">
    .noPrint{display:none;}
    .print{display:table-cell;}
</style>

</head>
<body class="bootstrap-admin-with-small-navbar">
<!-- small navbar -->
<div class="noPrint">

<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['username']; ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">更改用户名</a></li>
                                <li><a href="#">更改登录密码</a></li>
                                <li role="presentation" class="divider"></li>
                                <li>
                                    <?php
                                    $attributes = array('class'=>'log_out');
                                    echo anchor('admincontroller/logOut','退出登录',$attributes);
                                    ?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
</div>

<!-- main / large navbar -->
<div class="noPrint">

<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-header">
                    <?php
                    $attributes = array('class'=>'navbar-brand');
                    echo anchor('admincontroller/showAdminPanel','Copex 订餐系统-控制面板',$attributes);
                    ?>
                </div>
            </div>
        </div>
    </div><!-- /.container -->
</nav>
</div>


<div class="container">
<!-- left, vertical navbar & content -->
<div class="row">
<!-- left, vertical navbar -->

<div class="noPrint">

    <div class="col-md-2 bootstrap-admin-col-left">
        <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
            <li>
                <?php
                $attributes = array('id'=>'adminPanel');
                echo anchor('admincontroller/showAdminPanel','<i class="glyphicon glyphicon-chevron-right"></i> 关于Copex',$attributes);
                ?>
            </li>
            <li class="active">
                <?php
                $attributes = array('id'=>'manageOrder');
                echo anchor('admincontroller/showOrderPanel','<i class="glyphicon glyphicon-chevron-right"></i> 1. 订单管理',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id'=>'prepareDishes');
                echo anchor('preparecontroller/showDinerDishPanel','<i class="glyphicon glyphicon-chevron-right"></i> 2. 备餐管理',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id'=>'manageDiner');
                echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-chevron-right"></i> 3. 餐厅管理',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id'=>'manageDish');
                echo anchor('dishcontroller/showDishPanel','<i class="glyphicon glyphicon-chevron-right"></i> 4. 菜品管理',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id'=>'manageMenu');
                echo anchor('menucontroller/showMenuManage','<i class="glyphicon glyphicon-chevron-right"></i> 5. 菜单管理',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id'=>'manageVip');
                echo anchor('vipcontroller/showVipPanel','<i class="glyphicon glyphicon-chevron-right"></i> 6. 会员管理',$attributes);
                ?>
            </li>
            <li>
                <?php
                $attributes = array('id'=>'manageBasic');
                echo anchor('basiccontroller/showBasicManage','<i class="glyphicon glyphicon-chevron-right"></i> 7. 基本管理',$attributes);
                ?>
            </li>
        </ul>
    </div>
</div>

<!-- content -->
<div class="col-md-10">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>
                <?php
                echo $_SESSION['order_campus']['cname'];
                ?>
                 校区订单
            </h1>
        </div>
    </div>
</div>

<div class="row">
    <?php
    $attributes = array('id'=>'confirmPaid');
    echo form_open('admincontroller/confirmPaid',$attributes);
    echo form_close();
    ?>
    <?php
    $attributes = array('id'=>'confirmPickedup');
    echo form_open('admincontroller/confirmPickedup',$attributes);
    echo form_close();
    ?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">预备订单--(点击订单号查看详情)
                    <span class="noPrint">
                        <button form="confirmPickedup" class="btn btn-sm btn-primary" style="float: right;margin-left: 5px;">
                            <i class="glyphicon glyphicon-ok-sign"></i>
                            提交确认收货
                        </button>
                        <button form="confirmPaid" class="btn btn-sm btn-success" style="float: right;margin-left: 5px;">
                            <i class="glyphicon glyphicon-ok-sign"></i>
                            提交确认付款
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="printOrder()" style="float: right;margin-left: 5px;">
                            <i class="glyphicon glyphicon-print"></i>
                            打印订单
                        </button>
                    </span>
                </div>
            </div>
            <div class="bootstrap-admin-panel-content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>校区</th>
                        <th>用户</th>
                        <th>V卡号</th>
                        <th>电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>总价</th>
                        <th>Paid?</th>
                        <th>收款</th>
                        <th>已收货？</th>
                        <th>收货</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($prepareOrder)){
                        echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                    }else{
                        $num = count($prepareOrder);
                        echo '<input form="confirmPaid" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                        echo '<input form="confirmPickedup" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                        for($i=0;$i<$num;$i++){
                            echo '<tr>';
                            $oid = $prepareOrder[$i]->orderNumber;
                            echo '<td>';
                            $attributes = array('class'=>'noPrint');
                            echo anchor("admincontroller/showOrderDetail/$oid",$oid,$attributes);
                            echo '<p class="print">'.$oid.'</p>';
                            echo '</td>';
                            echo '<td>'.$prepareOrder[$i]->campus.'</td>';
                            echo '<td>'.$prepareOrder[$i]->userId.'</td>';
                            echo '<td>'.$prepareOrder[$i]->cardNumber.'</td>';
                            echo '<td>'.$prepareOrder[$i]->userPhone.'</td>';
                            $fordate = date("m月d日",strtotime($prepareOrder[$i]->forDate));
                            echo '<td>'.$fordate.'</td>';
                            echo '<td>'.$prepareOrder[$i]->orderDate.'</td>';
                            echo '<td>'."$".$prepareOrder[$i]->totalCost.'</td>';
                            if($prepareOrder[$i]->isPaid==0){
                                echo '<td>'."否".'</td>';
                                echo '<td><input form="confirmPaid" type="checkbox" name="order'.$i.'" value ="'.$prepareOrder[$i]->orderNumber.'" /></td>';
                            }elseif($prepareOrder[$i]->isPaid==1){
                                echo '<td>'."是".'</td>';
                                echo '<td><input form="confirmPaid" type="hidden" /></td>';
                            }

                            if($prepareOrder[$i]->isPickedup==0){
                                echo '<td>'."否".'</td>';
                                echo '<td><input form="confirmPickedup" type="checkbox" name="order'.$i.'" value ="'.$prepareOrder[$i]->orderNumber.'" /></td>';
                            }elseif($prepareOrder[$i]->isPickedup==1){
                                echo '<td>'."是".'</td>';
                                echo '<td><input form="confirmPickedup" type="hidden" /></td>';
                            }

                            echo '</tr>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    <div class="noPrint">
        <div class="row">
            <?php
            $attributes = array('id'=>'history_confirmPaid');
            echo form_open('admincontroller/confirmPaid',$attributes);
            echo form_close();
            ?>
            <?php
            $attributes = array('id'=>'history_confirmPickedup');
            echo form_open('admincontroller/confirmPickedup',$attributes);
            echo form_close();
            ?>
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="text-muted bootstrap-admin-box-title">订单历史--(点击订单号查看详情)
                            <button form="history_confirmPickedup" class="btn btn-sm btn-primary" style="float: right;margin-left: 5px;">
                                <i class="glyphicon glyphicon-ok-sign"></i>
                                提交确认收货
                            </button>
                            <button form="history_confirmPaid" class="btn btn-sm btn-success" style="float: right;">
                                <i class="glyphicon glyphicon-ok-sign"></i>
                                提交确认付款
                            </button>
                        </div>
                    </div>
                    <div class="bootstrap-admin-panel-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>订单号</th>
                                <th>校区</th>
                                <th>用户</th>
                                <th>VIP卡号</th>
                                <th>电话</th>
                                <th>取餐日期</th>
                                <th>下单时间</th>
                                <th>总价</th>
                                <th>Paid?</th>
                                <th>收款</th>
                                <th>已收货？</th>
                                <th>收货</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!isset($historyOrder)){
                                echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                            }
                            $num = count($historyOrder);
                            echo '<input form="history_confirmPaid" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                            echo '<input form="history_confirmPickedup" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                            for($i=0;$i<$num;$i++){
                                echo '<tr>';
                                echo '<td><a href="showOrderDetail/'.$historyOrder[$i]->orderNumber.'">';
                                echo $historyOrder[$i]->orderNumber;
                                echo '</a></td>';
                                echo '<td>'.$historyOrder[$i]->campus.'</td>';
                                echo '<td>'.$historyOrder[$i]->userId.'</td>';
                                echo '<td>'.$historyOrder[$i]->cardNumber.'</td>';
                                echo '<td>'.$historyOrder[$i]->userPhone.'</td>';
                                $fordate = date("m月d日",strtotime($historyOrder[$i]->forDate));
                                echo '<td>'.$fordate.'</td>';
                                echo '<td>'.$historyOrder[$i]->orderDate.'</td>';
                                echo '<td>'."$".$historyOrder[$i]->totalCost.'</td>';
                                if($historyOrder[$i]->isPaid==0){
                                    echo '<td>'."否".'</td>';
                                    echo '<td><input form="history_confirmPaid" type="checkbox" name="order'.$i.'" value ="'.$historyOrder[$i]->orderNumber.'" /></td>';
                                }elseif($historyOrder[$i]->isPaid==1){
                                    echo '<td>'."是".'</td>';
                                    echo '<td><input form="history_confirmPaid" type="hidden" /></td>';
                                }

                                if($historyOrder[$i]->isPickedup==0){
                                    echo '<td>'."否".'</td>';
                                    echo '<td><input form="history_confirmPickedup" type="checkbox" name="order'.$i.'" value ="'.$historyOrder[$i]->orderNumber.'" /></td>';
                                }elseif($historyOrder[$i]->isPickedup==1){
                                    echo '<td>'."是".'</td>';
                                    echo '<td><input form="history_confirmPickedup" type="hidden" /></td>';
                                }

                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


