<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/4/2015
 * Time: 5:42 PM
 */
?>
<script>
    function printOrder(){
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

        <!-- content -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>----<?php
                            echo '餐厅“'.$_SESSION['diner']['dname'].'”';
                            echo '----校区“'.$_SESSION['campusList']['cname'].'”';
                            ?>：订单详情</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">主食分配单
                                <span class="noPrint">
                                    <?php
                                    $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-right:5px;');
                                    echo anchor('preparecontroller/goback','<i class="glyphicon glyphicon-backward"> 回配餐主页</i>',$attributes);

                                    $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;margin-right:5px;');
                                    echo anchor('preparecontroller/showChooseCampus','<i class="glyphicon glyphicon-backward"> 返回校区选择</i>',$attributes);

                                    ?>
                                    <button class="btn btn-sm btn-success" onclick="printOrder()" style="float: right;margin-right: 5px;">
                                        <i class="glyphicon glyphicon-print"></i>
                                        打印菜品分配核对单
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>订单号</th>
                                    <th>菜名</th>
                                    <th>份数</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(empty($foodList)){
                                    echo "没有订单需要配餐。";
                                }else{
                                    foreach($foodList as $food){
                                        echo '<tr>';

                                        echo '<td>';
                                        $attributes = array('class'=>'noPrint');
                                        echo anchor("admincontroller/showOrderDetail/$food->oid",$food->oid,$attributes);
                                        echo '<p class="print">'.$food->oid.'</p>';
                                        echo '</td>';

                                        echo '<td>'.$food->fname.'</td>';
                                        echo '<td>'.$food->amount.'</td>';
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
                            <div class="text-muted bootstrap-admin-box-title">小食分配单</div>
                        </div>
                        <div class="bootstrap-admin-panel-content">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>订单号</th>
                                    <th>菜名</th>
                                    <th>份数</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(empty($sideList)){
                                    echo "没有订单需要配餐。";
                                }else{
                                    foreach($sideList as $side){
                                        echo '<tr>';

                                        echo '<td>';
                                        $attributes = array('class'=>'noPrint');
                                        echo anchor("admincontroller/showOrderDetail/$side->oid",$side->oid,$attributes);
                                        echo '<p class="print">'.$side->oid.'</p>';
                                        echo '</td>';

                                        echo '<td>'.$side->sname.'</td>';
                                        echo '<td>'.$side->amount.'</td>';
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

