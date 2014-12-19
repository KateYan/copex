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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">预备订单--(点击订单号查看详情)</div>
            </div>
            <div class="bootstrap-admin-panel-content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>收货校区</th>
                        <th>用户ID</th>
                        <th>用户类型</th>
                        <th>用户电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>总价</th>
                        <th>已付款？</th>
                        <th>确认付款</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($prepareOrder)){
                        echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                    }
                    foreach($prepareOrder as $order){
                        echo '<tr>';
                        echo '<td><a href="showOrderDetail/'.$order->orderNumber.'">';
                        echo $order->orderNumber;
                        echo '</a></td>';
                        echo '<td>'.$order->campus.'</td>';
                        echo '<td>'.$order->userId.'</td>';
                        if(empty($order->vipId)){
                            echo '<td>'."普通用户".'</td>';
                        }else{
                            echo '<td>'."VIP用户".'</td>';
                        }
                        echo '<td>'.$order->userPhone.'</td>';
                        echo '<td>'.$order->forDate.'</td>';
                        echo '<td>'.$order->orderDate.'</td>';
                        echo '<td>'."$".$order->totalCost.'</td>';
                        if($order->isPaid==0){
                            echo '<td>'."否".'</td>';
                            echo '<td><input type="checkbox" /></td>';
                        }elseif($order->isPaid==1){
                            echo '<td>'."是".'</td>';
                            echo '<td><input type="hidden" /></td>';
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">订单历史--(点击订单号查看详情)</div>
            </div>
            <div class="bootstrap-admin-panel-content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>收货校区</th>
                        <th>用户ID</th>
                        <th>用户类型</th>
                        <th>用户电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>总价</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($hitoryOrder)){
                        echo "订单历史为空。";
                    }
                    foreach($hitoryOrder as $order){
                        echo '<tr>';
                        echo '<td><a>';
                        echo $order->orderNumber;
                        echo '</a></td>';
                        echo '<td>'.$order->campus.'</td>';
                        echo '<td>'.$order->userId.'</td>';
                        if(empty($order->vipId)){
                            echo '<td>'."普通用户".'</td>';
                        }else{
                            echo '<td>'."VIP用户".'</td>';
                        }
                        echo '<td>'.$order->userPhone.'</td>';
                        echo '<td>'.$order->forDate.'</td>';
                        echo '<td>'.$order->orderDate.'</td>';
                        echo '<td>'."$".$order->totalCost.'</td>';
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
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">Table with actions</div>
            </div>
            <div class="bootstrap-admin-panel-content">
                <table class="table bootstrap-admin-table-with-actions">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td class="actions">
                            <a href="#">
                                <button class="btn btn-sm btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Edit
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-success">
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                    Confirm
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-warning">
                                    <i class="glyphicon glyphicon-bell"></i>
                                    Notify
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                        <td class="actions">
                            <a href="#">
                                <button class="btn btn-sm btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Edit
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-success">
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                    Confirm
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-warning">
                                    <i class="glyphicon glyphicon-bell"></i>
                                    Notify
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                        <td class="actions">
                            <a href="#">
                                <button class="btn btn-sm btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                    Edit
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-success">
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                    Confirm
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-warning">
                                    <i class="glyphicon glyphicon-bell"></i>
                                    Notify
                                </button>
                            </a>
                            <a href="#">
                                <button class="btn btn-sm btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i>
                                    Delete
                                </button>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
    <div class="text-muted bootstrap-admin-box-title">Bootstrap dataTables</div>
</div>
<div class="bootstrap-admin-panel-content">
<table class="table table-striped table-bordered" id="example">
<thead>
<tr>
    <th>Rendering engine</th>
    <th>Browser</th>
    <th>Platform(s)</th>
    <th>Engine version</th>
    <th>CSS grade</th>
</tr>
</thead>
<tbody>
<tr class="odd gradeX">
    <td>Trident</td>
    <td>Internet Explorer 4.0</td>
    <td>Win 95+</td>
    <td class="center"> 4</td>
    <td class="center">X</td>
</tr>
<tr class="even gradeC">
    <td>Trident</td>
    <td>Internet Explorer 5.0</td>
    <td>Win 95+</td>
    <td class="center">5</td>
    <td class="center">C</td>
</tr>
<tr class="odd gradeA">
    <td>Trident</td>
    <td>Internet Explorer 5.5</td>
    <td>Win 95+</td>
    <td class="center">5.5</td>
    <td class="center">A</td>
</tr>
<tr class="even gradeA">
    <td>Trident</td>
    <td>Internet Explorer 6</td>
    <td>Win 98+</td>
    <td class="center">6</td>
    <td class="center">A</td>
</tr>
<tr class="odd gradeA">
    <td>Trident</td>
    <td>Internet Explorer 7</td>
    <td>Win XP SP2+</td>
    <td class="center">7</td>
    <td class="center">A</td>
</tr>
<tr class="even gradeA">
    <td>Trident</td>
    <td>AOL browser (AOL desktop)</td>
    <td>Win XP</td>
    <td class="center">6</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 1.0</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 1.5</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 2.0</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Firefox 3.0</td>
    <td>Win 2k+ / OSX.3+</td>
    <td class="center">1.9</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Camino 1.0</td>
    <td>OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Camino 1.5</td>
    <td>OSX.3+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Netscape 7.2</td>
    <td>Win 95+ / Mac OS 8.6-9.2</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Netscape Browser 8</td>
    <td>Win 98SE+</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Netscape Navigator 9</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.0</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.1</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.1</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.2</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.2</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.3</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.3</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.4</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.4</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.5</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.5</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.6</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">1.6</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.7</td>
    <td>Win 98+ / OSX.1+</td>
    <td class="center">1.7</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Mozilla 1.8</td>
    <td>Win 98+ / OSX.1+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Seamonkey 1.1</td>
    <td>Win 98+ / OSX.2+</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Gecko</td>
    <td>Epiphany 2.20</td>
    <td>Gnome</td>
    <td class="center">1.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>Safari 1.2</td>
    <td>OSX.3</td>
    <td class="center">125.5</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>Safari 1.3</td>
    <td>OSX.3</td>
    <td class="center">312.8</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>Safari 2.0</td>
    <td>OSX.4+</td>
    <td class="center">419.3</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>Safari 3.0</td>
    <td>OSX.4+</td>
    <td class="center">522.1</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>OmniWeb 5.5</td>
    <td>OSX.4+</td>
    <td class="center">420</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>iPod Touch / iPhone</td>
    <td>iPod</td>
    <td class="center">420.1</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Webkit</td>
    <td>S60</td>
    <td>S60</td>
    <td class="center">413</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 7.0</td>
    <td>Win 95+ / OSX.1+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 7.5</td>
    <td>Win 95+ / OSX.2+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 8.0</td>
    <td>Win 95+ / OSX.2+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 8.5</td>
    <td>Win 95+ / OSX.2+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 9.0</td>
    <td>Win 95+ / OSX.3+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 9.2</td>
    <td>Win 88+ / OSX.3+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera 9.5</td>
    <td>Win 88+ / OSX.3+</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Opera for Wii</td>
    <td>Wii</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Nokia N800</td>
    <td>N800</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>Presto</td>
    <td>Nintendo DS browser</td>
    <td>Nintendo DS</td>
    <td class="center">8.5</td>
    <td class="center">C/A<sup>1</sup></td>
</tr>
<tr class="gradeC">
    <td>KHTML</td>
    <td>Konqureror 3.1</td>
    <td>KDE 3.1</td>
    <td class="center">3.1</td>
    <td class="center">C</td>
</tr>
<tr class="gradeA">
    <td>KHTML</td>
    <td>Konqureror 3.3</td>
    <td>KDE 3.3</td>
    <td class="center">3.3</td>
    <td class="center">A</td>
</tr>
<tr class="gradeA">
    <td>KHTML</td>
    <td>Konqureror 3.5</td>
    <td>KDE 3.5</td>
    <td class="center">3.5</td>
    <td class="center">A</td>
</tr>
<tr class="gradeX">
    <td>Tasman</td>
    <td>Internet Explorer 4.5</td>
    <td>Mac OS 8-9</td>
    <td class="center">-</td>
    <td class="center">X</td>
</tr>
<tr class="gradeC">
    <td>Tasman</td>
    <td>Internet Explorer 5.1</td>
    <td>Mac OS 7.6-9</td>
    <td class="center">1</td>
    <td class="center">C</td>
</tr>
<tr class="gradeC">
    <td>Tasman</td>
    <td>Internet Explorer 5.2</td>
    <td>Mac OS 8-X</td>
    <td class="center">1</td>
    <td class="center">C</td>
</tr>
<tr class="gradeA">
    <td>Misc</td>
    <td>NetFront 3.1</td>
    <td>Embedded devices</td>
    <td class="center">-</td>
    <td class="center">C</td>
</tr>
<tr class="gradeA">
    <td>Misc</td>
    <td>NetFront 3.4</td>
    <td>Embedded devices</td>
    <td class="center">-</td>
    <td class="center">A</td>
</tr>
<tr class="gradeX">
    <td>Misc</td>
    <td>Dillo 0.8</td>
    <td>Embedded devices</td>
    <td class="center">-</td>
    <td class="center">X</td>
</tr>
<tr class="gradeX">
    <td>Misc</td>
    <td>Links</td>
    <td>Text only</td>
    <td class="center">-</td>
    <td class="center">X</td>
</tr>
<tr class="gradeX">
    <td>Misc</td>
    <td>Lynx</td>
    <td>Text only</td>
    <td class="center">-</td>
    <td class="center">X</td>
</tr>
<tr class="gradeC">
    <td>Misc</td>
    <td>IE Mobile</td>
    <td>Windows Mobile 6</td>
    <td class="center">-</td>
    <td class="center">C</td>
</tr>
<tr class="gradeC">
    <td>Misc</td>
    <td>PSP browser</td>
    <td>PSP</td>
    <td class="center">-</td>
    <td class="center">C</td>
</tr>
<tr class="gradeU">
    <td>Other browsers</td>
    <td>All others</td>
    <td>-</td>
    <td class="center">-</td>
    <td class="center">U</td>
</tr>
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
