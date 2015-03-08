<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 3/1/2015
 * Time: 10:55 AM
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
                        <h1>校区管理--
                        <?php
                        echo $_SESSION['campus']['cname'];
                        ?>
                            --添加取餐地点
                        </h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">添加取餐地点
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;margin-right:5px;');
                                echo anchor('campuscontroller/goback','<i class="glyphicon glyphicon-backward"> 回校区管理主页</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>添加取餐地点
                                        <?php
                                        if(isset($eMsg['success'])){
                                            echo '<span style="color: #be2221;"><b>'.$eMsg['wrong'].'</b></span>';
                                        }
                                        ?>
                                    </legend>
                                    <?php
                                    $attributes = array('id'=>'addPickupPlace');
                                    echo form_open('campuscontroller/addPickupPlace',$attributes);
                                    echo form_close();
                                    ?>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput">校区ID</label>
                                        <div class="col-lg-10">
                                            <input readonly form="addPickupPlace" type="text" class="form-control" name="cid" value="<?php echo $_SESSION['campus']['cid']; ?>"/>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['noName'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">取餐地点名称</label>
                                        <div class="col-lg-10">
                                            <input form="addPickupPlace" class="form-control" type="text" name="placeName" />
                                            <span class="help-block">
                                                <?php
                                                if(isset($eMsg['noName'])){
                                                    echo $eMsg['noName'];
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['noPickupPlace'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label" for="optionsCheckbox2">取餐地点具体地址</label>
                                        <div class="col-lg-10">
                                            <input form="addPickupPlace" class="form-control" type="text" name="placeAddr" />
                                            <span class="help-block">
                                                <?php
                                                if(isset($eMsg['noPickupPlace'])){
                                                    echo $eMsg['noPickupPlace'];
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>


                                    <button form="addPickupPlace" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <?php
                                    $attributes = array('type'=>'reset','class'=>'btn btn-default');
                                    echo anchor('campuscontroller/showAddPickupPlace','<i class="glyphicon glyphicon-refresh"> 取消修改</i>',$attributes);

                                    $attributes1 = array('class'=>'btn btn-success','type'=>'reset','style'=>'margin-left:5px;');
                                    echo anchor('campuscontroller/goback','<i class="glyphicon glyphicon-backward"> 回校区管理主页</i>',$attributes1);
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
