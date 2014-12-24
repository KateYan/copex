<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/24/2014
 * Time: 1:51 PM
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
                <li>
                    <?php
                    $attributes = array('id'=>'adminPanel');
                    echo anchor('admincontroller/showAdminPanel','<i class="glyphicon glyphicon-chevron-right"></i> 关于Copex',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageOrder');
                    echo anchor('admincontroller/showOrderManage','<i class="glyphicon glyphicon-chevron-right"></i> 1. 订单管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageDiner');
                    echo anchor('dinercontroller/showDinerManage','<i class="glyphicon glyphicon-chevron-right"></i> 2. 餐厅管理',$attributes);
                    ?>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageDish');
                    echo anchor('dishcontroller/showDishManage','<i class="glyphicon glyphicon-chevron-right"></i> 3. 菜品管理',$attributes);
                    ?>
                </li>
                <li class="active">
                    <?php
                    $attributes = array('id'=>'manageMenu');
                    echo anchor('menucontroller/showMenuManage','<i class="glyphicon glyphicon-chevron-right"></i> 4. 菜单管理',$attributes);
                    ?>
                </li>
                <li>
                    <a href="../vipcontroller/showVipPanel"><i class="glyphicon glyphicon-chevron-right"></i> 5. 会员管理</a>
                </li>
                <li>
                    <?php
                    $attributes = array('id'=>'manageBasic');
                    echo anchor('basiccontroller/showBasicManage','<i class="glyphicon glyphicon-chevron-right"></i> 6. 基本管理',$attributes);
                    ?>
                </li>
            </ul>
        </div>

        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>菜单管理----校区<?php echo $menus[0]->cname; ?></h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">主食-菜单历史</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>菜单ID</th>
                                    <th>菜单生成时间</th>
                                    <th>菜单状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($menus)){
                                    echo "本该校区暂时还未添加任何主食菜单！";
                                }else{
                                    foreach($menus as $menu){
                                        echo '<tr>';
                                        echo '<td><a href="showEditMenu?menuId='.$menu->mid.'">';
                                        echo $menu->mid;
                                        echo '</a></td>';
                                        echo '<td>'.$menu->mdate.'</td>';
                                        if($menu->mstatus == 1){
                                            echo '<td>'."正在使用".'</td>';
                                        }else{
                                            echo '<td>'."已关闭".'</td>';
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">小食-菜单历史</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>菜单ID</th>
                                    <th>菜单生成时间</th>
                                    <th>菜单状态</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($sidemenus)){
                                    echo "本该校区暂时还未添加任何小食菜单！";
                                }else{
                                    foreach($sidemenus as $sidemenu){
                                        echo '<tr>';
                                        echo '<td><a href="showEditMenu?sidemenuId='.$sidemenu->sideMenuID.'">';
                                        echo $sidemenu->sideMenuID;
                                        echo '</a></td>';
                                        echo '<td>'.$sidemenu->sideMenuDate.'</td>';
                                        if($sidemenu->sideMenuStatus == 1){
                                            echo '<td>'."正在使用".'</td>';
                                        }else{
                                            echo '<td>'."已关闭".'</td>';
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

        </div>
    </div>
</div>
