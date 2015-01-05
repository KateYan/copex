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
                <li class="active">
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

        <!-- content -->
        <div class="col-md-10">
            <div class="row">
                <?php
                $attributes = array('id'=>'menuStatus');
                echo form_open('menucontroller/changeMenuStatus',$attributes);
                echo form_close();
                ?>
                <?php
                $attributes = array('id'=>'sideMenuStatus');
                echo form_open('menucontroller/changeSideMenuStatus',$attributes);
                echo form_close();
                ?>
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>菜单管理----校区<?php echo $_SESSION['menu_campus']['cname']; ?></h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">主食-菜单历史
                                <?php
                                if(isset($Msg['menuchanged'])){
                                    echo '<span style="color: #be2221;"><b>'.$Msg['menuchanged'].'</b></span>';
                                }

                                $attributes = array('class'=>'btn btn-sm btn-success','style'=>'float: right;');
                                echo anchor('menucontroller/showAddMenu','<i class="glyphicon glyphicon-plus"></i>
                                         添加主食菜单',$attributes);
                                ?>
                                <input type="hidden" form="menuStatus" name="menu-campus" value="<?php echo $_SESSION['menu_campus']['cid']; ?>"/>
                                <button form="menuStatus" class="btn btn-sm btn-primary" style="float: right;margin-right: 5px;">
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                    变更主食菜单
                                </button>
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>主食菜单ID</th>
                                    <th>菜单生成时间</th>
                                    <th>菜单状态</th>
                                    <th>使用菜单</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($_SESSION['menus'])){
                                    echo "本该校区暂时还未添加任何主食菜单！";
                                }else{
                                    $num = count($_SESSION['menus']);
                                    for($i = 0;$i < $num; $i++){
                                        $menus = $_SESSION['menus'];
                                        echo '<tr>';
                                        echo '<td>';
                                        echo anchor("menucontroller/showMenuDetail?menuId=".$menus[$i]->mid,$menus[$i]->mid);
                                        echo '</td>';
                                        echo '<td>'.$menus[$i]->mdate.'</td>';
                                        if($menus[$i]->mstatus == 1){
                                            echo '<td>'."正在使用".'</td>';
                                        }else{
                                            echo '<td>'."已关闭".'</td>';
                                        }
                                        echo '<td><input form="menuStatus" type="radio" name="menu" value ="'.$menus[$i]->mid.'" /></td>';
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
                            <div class="text-muted bootstrap-admin-box-title">小食-菜单历史
                                <?php
                                if(isset($Msg['sidemenuchanged'])){
                                    echo '<span style="color: #be2221;"><b>'.$Msg['sidemenuchanged'].'</b></span>';
                                }

                                $attributes = array('class'=>'btn btn-sm btn-success','style'=>'float: right;');
                                echo anchor('menucontroller/showAddSideMenu','<i class="glyphicon glyphicon-plus"></i>
                                         添加小食菜单',$attributes);
                                ?>
                                <input type="hidden" form="sideMenuStatus" name="sidemenu-campus" value="<?php echo $_SESSION['menu_campus']['cid']; ?>"/>
                                <button form="sideMenuStatus" class="btn btn-sm btn-primary" style="float: right;margin-right: 5px;">
                                    <i class="glyphicon glyphicon-ok-sign"></i>
                                    变更小食菜单
                                </button>
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>小食菜单ID</th>
                                    <th>菜单生成时间</th>
                                    <th>菜单状态</th>
                                    <th>使用菜单</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!isset($_SESSION['sideMenus'])){
                                    echo "本该校区暂时还未添加任何小食菜单！";
                                }else{
                                    $number = count($_SESSION['sideMenus']);
                                    for($j = 0; $j< $number; $j++){
                                        $sideMenus = $_SESSION['sideMenus'];
                                        echo '<tr>';
                                        echo '<td>';
                                        echo anchor("menucontroller/showSideMenuDetail?sideMenuId=".$sideMenus[$j]->sideMenuID,$sideMenus[$j]->sideMenuID);
                                        echo '</td>';
                                        echo '<td>'.$sideMenus[$j]->sideMenuDate.'</td>';
                                        if($sideMenus[$j]->sideMenuStatus == 1){
                                            echo '<td>'."正在使用".'</td>';
                                        }else{
                                            echo '<td>'."已关闭".'</td>';
                                        }
                                        echo '<td><input form="sideMenuStatus" type="radio" name="sideMenu" value ="'.$sideMenus[$j]->sideMenuID.'" /></td>';
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
