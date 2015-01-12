<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/6/2015
 * Time: 8:33 PM
 */
?>
<!-- Vendors -->
<link rel="stylesheet" media="screen" href="vendors/bootstrap-datepicker/css/datepicker.css">
<link rel="stylesheet" media="screen" href="css/datepicker.fixes.css">
<link rel="stylesheet" media="screen" href="vendors/uniform/themes/default/css/uniform.default.min.css">
<link rel="stylesheet" media="screen" href="css/uniform.default.fixes.css">
<link rel="stylesheet" media="screen" href="vendors/chosen.min.css">
<link rel="stylesheet" media="screen" href="vendors/selectize/dist/css/selectize.bootstrap3.css">
<link rel="stylesheet" media="screen" href="vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

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

        <!-- content -->
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1>订单详情
                            <?php
                            if(isset($eMsg['notsafe'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['notsafe'].'</b></span>';
                            }
                            ?>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <?php
                            $attributes = array('id'=>'deleteOrder');
                            echo form_open('admincontroller/deleteOrder',$attributes);
                            echo form_close();
                            ?>
                            <div class="text-muted bootstrap-admin-box-title">订单详情
                                <input form="deleteOrder" type="hidden" name="orderId" value="<?php echo $_SESSION['orderDetail']['order']->oid;?>"/>
                                <button form="deleteOrder" type="submit" class="btn btn-sm btn-danger" style="float: right;margin-left:5px;">
                                    <i class="glyphicon glyphicon-remove"> 删除该菜单</i>
                                </button>
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-left:5px;');
                                echo anchor('admincontroller/goback','<i class="glyphicon glyphicon-backward"> 回订单管理主页</i>',$attributes);

                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;');
                                echo anchor('admincontroller/showOrders','<i class="glyphicon glyphicon-backward"> 回校区-订单列表</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>订单ID:
                                        <?php
                                        echo $_SESSION['orderDetail']['order']->oid;
                                        echo "--用户ID:";
                                        echo $_SESSION['orderDetail']['order']->uid;
                                        echo "--校区:";
                                        echo $_SESSION['orderDetail']['order']->cname;
                                        ?>
                                    </legend>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">下单时间</label>
                                        <div class="col-lg-10">
                                            <input readonly  class="form-control"  value="<?php echo $_SESSION['orderDetail']['order']->odate; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">取餐日期</label>
                                        <div class="col-lg-10">
                                            <input readonly class="form-control" type="text"  value="<?php echo $_SESSION['orderDetail']['order']->fordate;?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="disabledInput">付款状态</label>
                                        <div class="col-lg-10">
                                            <input readonly class="form-control" type="text"  value="<?php if($_SESSION['orderDetail']['order']->oispaid==1){echo "已付款";}else{echo "未付款";}?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="disabledInput">取餐状态</label>
                                        <div class="col-lg-10">
                                            <input readonly class="form-control" type="text"  value="<?php if($_SESSION['orderDetail']['order']->ostatus==1){echo "已取餐";}else{echo "未取餐";}?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">税款</label>
                                        <div class="col-lg-10">
                                            <input readonly class="form-control" type="text" value="<?php echo '$'.$_SESSION['orderDetail']['order']->tax;?>"/>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">总价</label>
                                        <div class="col-lg-10">
                                            <input readonly class="form-control" type="text" value="<?php echo '$'.$_SESSION['orderDetail']['order']->totalcost;?>"/>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">订单菜品</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title">订单包含菜品如下
                                                    </div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>菜名</th>
                                                            <th>单价</th>
                                                            <th>数量</th>
                                                            <th>供应餐厅</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $num = count($_SESSION['orderDetail']['food']);
                                                        for($i = 0;$i<$num; $i++){
                                                            echo '<tr>';
                                                            echo '<th>'.$_SESSION['orderDetail']['food'][$i]->fname.'</th>';
                                                            echo '<th>$'.$_SESSION['orderDetail']['food'][$i]->price.'</th>';
                                                            echo '<th>'.$_SESSION['orderDetail']['food'][$i]->amount.'</th>';
                                                            echo '<th>'.$_SESSION['orderDetail']['food'][$i]->dname.'</th>';
                                                            echo '</tr>';
                                                        }
                                                        $num = count($_SESSION['orderDetail']['side']);
                                                        for($i = 0;$i<$num; $i++){
                                                            echo '<tr>';
                                                            echo '<th>'.$_SESSION['orderDetail']['side'][$i]->sname.'</th>';
                                                            echo '<th>$'.$_SESSION['orderDetail']['side'][$i]->price.'</th>';
                                                            echo '<th>'.$_SESSION['orderDetail']['side'][$i]->amount.'</th>';
                                                            echo '<th>'.$_SESSION['orderDetail']['side'][$i]->dname.'</th>';
                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
