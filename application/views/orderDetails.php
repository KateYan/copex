<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 1:53 PM
 */
?>

<script>
    function printOrder(){
        window.print()
    }
</script>

</head>
<body class="bootstrap-admin-with-small-navbar">
<!-- small navbar -->
<nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $username; ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">更改用户名</a></li>
                                <li><a href="#">更改登录密码</a></li>
                                <li role="presentation" class="divider"></li>
                                <li>
                                    <?php
                                    $attributes = array('class'=>'log_out');
                                    echo anchor('admincontroller/showAdminLogin','退出登录',$attributes);
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

<!-- main / large navbar -->
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

<div class="container">
<!-- left, vertical navbar & content -->
<div class="row">

<!-- content -->
<div class="col-md-12">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>订单详情</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">订单详情
                    <button class="btn btn-sm btn-primary" onclick="printOrder()" style="float: right;margin-left: 5px;">
                        <i class="glyphicon glyphicon-print"></i>
                        打印订单
                    </button>
                    <a class="btn btn-sm btn-success" href="../showOrderManage" style="float: right;">
                        <i class="glyphicon glyphicon-backward"></i>
                        返回订单列表
                    </a>
                </div>
            </div>
            <div class="bootstrap-admin-panel-content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>校区</th>
                        <th>用户</th>
                        <th>用户类型</th>
                        <th>用户电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>菜品</th>
                        <th>品种</th>
                        <th>单价</th>
                        <th>货源餐厅</th>
                        <th>已付款?</th>
                        <th>已收货？</th>
                        <th>税款</th>
                        <th>总价</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($orderFood)){
                        echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                    }
                    foreach($orderFood as $order){
                        echo '<tr>';
                        echo '<td><a href="showOrderDetail/'.$order->oid.'">';
                        echo $order->oid;
                        echo '</a></td>';
                        echo '<td>'.$order->cname.'</td>';
                        echo '<td>'.$order->uid.'</td>';
                        if(empty($order->vipid)){
                            echo '<td>'."普通用户".'</td>';
                        }else{
                            echo '<td>'."VIP用户".'</td>';
                        }
                        echo '<td>'.$order->uphone.'</td>';
                        echo '<td>'.$order->fordate.'</td>';
                        echo '<td>'.$order->odate.'</td>';
                        echo '<td>'.$order->fname.'</td>';
                        if($order->dishtype==0){
                            echo '<td>'."主食".'</td>';
                        }elseif($order->dishtype==1){
                            echo '<td>'."小食".'</td>';
                        }else{
                            echo '<td>'."N/A".'</td>';
                        }
                        echo '<td>'."$".$order->fprice.'</td>';
                        echo '<td>'.$order->dname.'</td>';
                        if($order->oispaid==0){
                            echo '<td>'."暂未".'</td>';
                        }elseif($order->oispaid==1){
                            echo '<td>'."是".'</td>';
                        }else{
                            echo '<td>'."N/A".'</td>';
                        }
                        if($order->ostatus==0){
                            echo '<td>'."暂未".'</td>';
                        }elseif($order->ostatus==1){
                            echo '<td>'."是".'</td>';
                        }else{
                            echo '<td>'."N/A".'</td>';
                        }
                        echo '<td>'.$order->tax.'</td>';
                        echo '<td>'."$".$order->totalcost.'</td>';
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

<!-- footer -->
<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">Copex 订餐管理系统</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/copex/bootstrap/js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/DT_bootstrap.js"></script>
</body>
</html>

