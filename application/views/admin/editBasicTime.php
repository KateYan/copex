<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/23/2014
 * Time: 4:49 PM
 */
?>
<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 10:24 PM
 */
?>
<!-- Vendors -->
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/bootstrap-datepicker/css/datepicker.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/datepicker.fixes.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/uniform/themes/default/css/uniform.default.min.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/css/uniform.default.fixes.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/chosen.min.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/selectize/dist/css/selectize.bootstrap3.css">
<link rel="stylesheet" media="screen" href="/copex/bootstrap/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/core-b3.css">

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
                        <h1>基本管理
                            <?php
                            if(isset($eMsg['success'])){
                                echo '<span style="color: #be2221;"><b>'.$eMsg['success'].'</b></span>';
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
                            <div class="text-muted bootstrap-admin-box-title">时间规则管理

                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-info','type'=>'reset','style'=>'float:right;');
                                echo anchor('basiccontroller/goback','<i class="glyphicon glyphicon-backward"> 回基本管理主页</i>',$attributes);
                                ?>

                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <?php
                                $attributes = array('id'=>'editTime');
                                echo form_open('basiccontroller/editTime',$attributes);
                                echo form_close();
                                ?>
                                <fieldset>
                                    <legend>用户类型:
                                        <?php
                                        if($_SESSION['rule']['userType'] =="user"){
                                            echo "普通用户";
                                        }else{
                                            echo "VIP用户";
                                        }
                                        echo '<input form="editTime" type="hidden" name="userType" value="'.$_SESSION['rule']['userType'].'" />'
                                        ?>
                                    </legend>
                                    <div class="form-group<?php if(isset($eMsg['pstartwrg'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label" for="focusedInput">取餐起始时间</label>
                                        <div class="col-lg-10">
                                            <input form="editTime" class="form-control" type="text" name="pickup-start" value="<?php echo $_SESSION['rule']['timeRange']['value'][0]; ?>"/>
                                            <span class="help-block">
                                                <?php
                                                if(isset($eMsg['pstartwrg'])){
                                                    echo $eMsg['pstartwrg'];
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['pendwrg'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">取餐结束时间</label>
                                        <div class="col-lg-10">
                                            <input form="editTime" class="form-control" type="text" name="pickup-end" value="<?php echo $_SESSION['rule']['timeRange']['value'][1]; ?>"/>
                                            <span class="help-block">
                                                <?php
                                                if(isset($eMsg['pendwrg'])){
                                                    echo $eMsg['pendwrg'];
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['ostartwrg'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">下单起始时间</label>
                                        <div class="col-lg-10">
                                            <input readonly form="editTime" class="form-control" type="text" name="order-start" value="<?php echo $_SESSION['rule']['timeRange']['value'][2]; ?>"/>
                                            <span class="help-block">
                                                <?php
                                                if(isset($eMsg['ostartwrg'])){
                                                    echo $eMsg['ostartwrg'];
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['oendwrg'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">下单结束时间</label>
                                        <div class="col-lg-10">
                                            <input form="editTime" class="form-control" type="text" name="order-end" value="<?php echo $_SESSION['rule']['timeRange']['value'][3]; ?>"/>
                                            <span class="help-block"><?php
                                                if(isset($eMsg['oendwrg'])){
                                                    echo $eMsg['oendwrg'];
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <button form="editTime" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <a type="reset" href="../showEditVip/" class="btn btn-default">
                                        <i class="glyphicon glyphicon-refresh"> 取消修改</i>
                                    </a>
                                    <?php
                                    $attributes = array('class'=>'btn btn-success','type'=>'reset');
                                    echo anchor('basiccontroller/goback','<i class="glyphicon glyphicon-backward"> 回基本管理</i>',$attributes);
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

