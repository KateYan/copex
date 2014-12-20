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
<!-- left, vertical navbar -->
<div class="col-md-2 bootstrap-admin-col-left">
    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
        <li class="active">
            <a href="showAdminPanel"><i class="glyphicon glyphicon-chevron-right"></i> 关于Copex</a>
        </li>
        <li>
            <a href="showOrderManage"><i class="glyphicon glyphicon-chevron-right"></i> 1. 订单管理</a>
        </li>
        <li>
            <a href="forms.html"><i class="glyphicon glyphicon-chevron-right"></i> 2. 餐厅管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 3. 菜品管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 4. 菜单管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 5. 会员管理</a>
        </li>
        <li>
            <a href="tables.html"><i class="glyphicon glyphicon-chevron-right"></i> 6. 基本管理</a>
        </li>
        <li>
            <a href="buttons-and-icons.html"><i class="glyphicon glyphicon-chevron-right"></i> Buttons &amp; Icons</a>
        </li>
        <li>
            <a href="wysiwyg-editors.html"><i class="glyphicon glyphicon-chevron-right"></i> WYSIWYG Editors</a>
        </li>
        <li>
            <a href="ui-and-interface.html"><i class="glyphicon glyphicon-chevron-right"></i> UI &amp; Interface</a>
        </li>
        <li>
            <a href="error-pages.html"><i class="glyphicon glyphicon-chevron-right"></i> Error pages</a>
        </li>
    </ul>
</div>

<!-- content -->
<div class="col-md-10">
<div class="row">
    <div class="col-lg-12">
        <div class="page-header">
            <h1>订单</h1>
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
                    <button form="confirmPickedup" class="btn btn-sm btn-primary" style="float: right;margin-left: 5px;">
                        <i class="glyphicon glyphicon-ok-sign"></i>
                        提交确认收货
                    </button>
                    <button form="confirmPaid" class="btn btn-sm btn-success" style="float: right;">
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
                        <th>类型</th>
                        <th>电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>总价</th>
                        <th>已付款？</th>
                        <th>去收款</th>
                        <th>已收货？</th>
                        <th>去收货</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($prepareOrder)){
                        echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                    }
                    $num = count($prepareOrder);
                    echo '<input form="confirmPaid" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                    echo '<input form="confirmPickedup" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                    for($i=0;$i<$num;$i++){
                        echo '<tr>';
                        echo '<td><a href="showOrderDetail/'.$prepareOrder[$i]->orderNumber.'">';
                        echo $prepareOrder[$i]->orderNumber;
                        echo '</a></td>';
                        echo '<td>'.$prepareOrder[$i]->campus.'</td>';
                        echo '<td>'.$prepareOrder[$i]->userId.'</td>';
                        if(empty($prepareOrder[$i]->vipId)){
                            echo '<td>'."普通用户".'</td>';
                        }else{
                            echo '<td>'."VIP用户".'</td>';
                        }
                        echo '<td>'.$prepareOrder[$i]->userPhone.'</td>';
                        echo '<td>'.$prepareOrder[$i]->forDate.'</td>';
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
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                        <th>类型</th>
                        <th>电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>总价</th>
                        <th>已付款？</th>
                        <th>去收款</th>
                        <th>已收货？</th>
                        <th>去收货</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($hitoryOrder)){
                        echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                    }
                    $num = count($hitoryOrder);
                    echo '<input form="history_confirmPaid" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                    echo '<input form="history_confirmPickedup" type="hidden" name = "orderNumber" value="'.$num.'"/>';
                    for($i=0;$i<$num;$i++){
                        echo '<tr>';
                        echo '<td><a href="showOrderDetail/'.$hitoryOrder[$i]->orderNumber.'">';
                        echo $hitoryOrder[$i]->orderNumber;
                        echo '</a></td>';
                        echo '<td>'.$hitoryOrder[$i]->campus.'</td>';
                        echo '<td>'.$hitoryOrder[$i]->userId.'</td>';
                        if(empty($hitoryOrder[$i]->vipId)){
                            echo '<td>'."普通用户".'</td>';
                        }else{
                            echo '<td>'."VIP用户".'</td>';
                        }
                        echo '<td>'.$hitoryOrder[$i]->userPhone.'</td>';
                        echo '<td>'.$hitoryOrder[$i]->forDate.'</td>';
                        echo '<td>'.$hitoryOrder[$i]->orderDate.'</td>';
                        echo '<td>'."$".$hitoryOrder[$i]->totalCost.'</td>';
                        if($hitoryOrder[$i]->isPaid==0){
                            echo '<td>'."否".'</td>';
                            echo '<td><input form="history_confirmPaid" type="checkbox" name="order'.$i.'" value ="'.$hitoryOrder[$i]->orderNumber.'" /></td>';
                        }elseif($hitoryOrder[$i]->isPaid==1){
                            echo '<td>'."是".'</td>';
                            echo '<td><input form="history_confirmPaid" type="hidden" /></td>';
                        }

                        if($hitoryOrder[$i]->isPickedup==0){
                            echo '<td>'."否".'</td>';
                            echo '<td><input form="history_confirmPickedup" type="checkbox" name="order'.$i.'" value ="'.$hitoryOrder[$i]->orderNumber.'" /></td>';
                        }elseif($hitoryOrder[$i]->isPickedup==1){
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
