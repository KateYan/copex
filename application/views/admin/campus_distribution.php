<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/6/2015
 * Time: 11:33 AM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 1:21 AM
 */
?>
<!-- Datatables -->
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/DT_bootstrap.css">
<link rel="stylesheet" media="print" href="/copex/bootstrap/css/DT_bootstrap.css">
<script>
    function printDishes(){
        window.print()
    }
</script>
<style type="text/css" media="screen">
</style>
<style type="text/css" media="print">
    .noPrint{display:none;}
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
        <div class="noPrint">
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
                    <li class="active">
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
                        <h1>----<?php
                            echo '餐厅“'.$_SESSION['diner']['dname'].'”';
                            echo '----校区“'.$_SESSION['campusList']['cname'].'”';
                            ?>：配餐详情</h1>
                    </div>
                </div>
            </div>

           <?php

               // table top

               echo '<div class="row">';
               echo '<div class="col-lg-12">';
               echo '<div class="panel panel-default">';

               echo '<div class="panel-heading">';
               echo '<div class="text-muted bootstrap-admin-box-title">'."校区" .$_SESSION['campusList']['cname'];
               echo '<span class="noPrint">';

               $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-right:5px;');
               echo anchor('preparecontroller/goback','<i class="glyphicon glyphicon-backward"> 回配餐主页</i>',$attributes);

               $attributes = array('id'=>'distribution','class'=>'btn btn-sm btn-success','style'=>'float: right;margin-right:5px;');
               echo anchor('preparecontroller/showOrderDistribution','<i class="glyphicon glyphicon-search"></i>
                                             查看订单分配',$attributes);


               echo '<button class="btn btn-sm btn-primary" onclick="printDishes()" style="float: right;margin-right: 5px;">';

               echo '<i class="glyphicon glyphicon-ok-sign"></i>'."打印需要准备的菜品列表";

               echo '</button>';
               echo '</span></div></div>';

               // dish table----------start
               echo '<div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">';
               echo '<div class="form-horizontal">';
               echo '<fieldset>';

               // food table---start
               echo '<div class="form-group">';
               echo '<label class="col-lg-2 control-label" for="optionsCheckbox2">准备主食</label>';
               echo '<div class="col-lg-10">';
               echo '<div class="panel panel-default">';
               echo '<div class="panel-heading">';
               echo '<div class="text-muted bootstrap-admin-box-title">备餐主食</div>';

               echo '</div>';

               // table food start
               echo '<div class="bootstrap-admin-panel-content">';
               echo '<table class="table table-striped">';

               echo '<thead>';
               echo '<tr>';
               echo '<th>菜品ID</th>';
               echo '<th>菜名</th>';
               echo '<th>份数</th>';
               echo '</tr>';
               echo '</thead>';

               echo '<tbody>';
               if(empty($_SESSION['campusList']['foodList'])){
                   echo "本餐厅不需要为该校区准备主食";
               }else{
                   $num = count($_SESSION['campusList']['foodList']);
                   foreach($_SESSION['campusList']['foodList'] as $food){
                       echo '<tr>';
                       echo '<td>'.$food['fid'].'</td>';
                       echo '<td>'.$food['fname'].'</td>';
                       echo '<td>'.$food['amount'].'</td>';
                       echo '</tr>';
                   }
               }

               echo '</tbody>';
               echo '</table>';
               echo '</div>';
               // table food end
               echo '</div>';
               echo '</div>';
               echo '</div>';
               // food table---end


               // side dish table---start
               echo '<div class="form-group">';
               echo '<label class="col-lg-2 control-label" for="optionsCheckbox2">准备小食</label>';
               echo '<div class="col-lg-10">';
               echo '<div class="panel panel-default">';
               echo '<div class="panel-heading">';
               echo '<div class="text-muted bootstrap-admin-box-title">备餐小食</div>';

               echo '</div>';

               // table food start
               echo '<div class="bootstrap-admin-panel-content">';
               echo '<table class="table table-striped">';

               echo '<thead>';
               echo '<tr>';
               echo '<th>菜品ID</th>';
               echo '<th>菜名</th>';
               echo '<th>份数</th>';
               echo '</tr>';
               echo '</thead>';

               echo '<tbody>';
               if(empty($_SESSION['campusList']['sideList'])){
                   echo "本餐厅不需要为该校区准备主食";
               }else{
                   $num = count($_SESSION['campusList']['sideList']);
                   foreach($_SESSION['campusList']['sideList'] as $side){
                       echo '<tr>';
                       echo '<td>'.$side['sid'].'</td>';
                       echo '<td>'.$side['sname'].'</td>';
                       echo '<td>'.$side['amount'].'</td>';
                       echo '</tr>';
                   }
               }

               echo '</tbody>';
               echo '</table>';
               echo '</div>';
               // table side dish end
               echo '</div>';
               echo '</div>';
               echo '</div>';
               // side dish table---end

               echo '</fieldset>';
               echo '</div>';
               echo '</div>';
               // dish table----------end

               echo '</div>';
               echo '</div>';
               echo '</div>';

           ?>
        </div>
    </div>
</div>


