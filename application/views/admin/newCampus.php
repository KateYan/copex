<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/30/2014
 * Time: 1:11 PM
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
                        <h1>校区管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">校区管理
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-top:0px;');
                                echo anchor('campuscontroller/goback','<i class="glyphicon glyphicon-backward"> 回校区管理主页</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>添加新校区
                                        <?php
                                        if(isset($eMsg['wrong'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                        }elseif(isset($eMsg['timewrong'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['timewrong'].'</b></span>';
                                        }
                                        ?>
                                    </legend>
                                    <?php
                                    $attributes = array('id'=>'addCampus');
                                    echo form_open('campuscontroller/addCampus',$attributes);
                                    echo form_close();
                                    ?>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">校区名</label>
                                        <div class="col-lg-10">
                                            <input form="addCampus" class="form-control" type="text" name="cname" required />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="disabledInput">校区地址</label>
                                        <div class="col-lg-10">
                                            <input form="addCampus" class="form-control" type="text" name="caddr" required />
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">添加配餐餐厅</label>
                                        <div class="col-lg-10">
                                            <span>
                                            <?php
                                            $num_diner = count($diner);
                                            for($j = 0; $j<$num_diner; $j++){
                                                echo '<label style="padding-right: 15px;">';
                                                echo '<input form="addCampus" type="checkbox"';
                                                echo 'name="add_diner'.$j.'" value="'.$diner[$j]->did.'"/>';
                                                echo "  ".$diner[$j]->dname;
                                                echo '</label>';
                                            }
                                            echo "  配餐餐厅还可以稍后在餐厅编辑中添加";
                                            ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" >普通用户时间设置</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title">下单时间段 + 取餐时间段</div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>下单开始时间</th>
                                                            <th>下单结束时间</th>
                                                            <th>取餐开始时间</th>
                                                            <th>取餐结束时间</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><input form="addCampus" class="form-control" type="text" name="userOrderStart"/></td>
                                                            <td><input form="addCampus" class="form-control" type="text" name="userOrderEnd"/></td>
                                                            <td><input form="addCampus" class="form-control" type="text" name="userPickupStart"/></td>
                                                            <td><input form="addCampus" class="form-control" type="text" name="userPickupEnd"/></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" >VIP时间设置</label>
                                        <div class="col-lg-10">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <div class="text-muted bootstrap-admin-box-title">下单时间段 + 取餐时间段</div>
                                                </div>
                                                <div class="bootstrap-admin-panel-content">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>下单开始时间</th>
                                                            <th>下单结束时间</th>
                                                            <th>取餐开始时间</th>
                                                            <th>取餐结束时间</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><input form="addCampus" class="form-control" type="text" name="vipOrderStart"/></td>
                                                            <td><input form="addCampus" class="form-control" type="text" name="vipOrderEnd"/></td>
                                                            <td><input form="addCampus" class="form-control" type="text" name="vipPickupStart"/></td>
                                                            <td><input form="addCampus" class="form-control" type="text" name="vipPickupEnd"/></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button form="addCampus" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <?php
                                    $attributes = array('class'=>'btn btn-success','type'=>'reset');
                                    echo anchor('campuscontroller/goback','<i class="glyphicon glyphicon-backward"> 回校区管理主页</i>',$attributes);
                                    ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
