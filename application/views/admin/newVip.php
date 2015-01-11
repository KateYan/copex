<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/20/2014
 * Time: 1:45 PM
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
                        <h1>VIP-会员管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">添加新会员
                                <?php
                                $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-top:0px;');
                                echo anchor('vipcontroller/goback','<i class="glyphicon glyphicon-backward"> 回VIP列表</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <?php
                                    if(isset($eMsg['wrong'])){
                                        echo '<legend style="color: #be2221;">'.$eMsg['wrong'].'</legend>';
                                    } elseif(isset($eMsg['success'])){
                                        echo '<legend style="color: #be2221;">'.$eMsg['success'].'</legend>';
                                    }elseif(isset($eMsg['faild'])){
                                        echo '<legend style="color: #be2221;">'.$eMsg['faild'].'</legend>';
                                    }else{
                                        echo '<legend>请输入新会员信息</legend>';
                                    }
                                    ?>
                                    <?php
                                    $attributes = array('id'=>'addVip');
                                    echo form_open('vipcontroller/addVip',$attributes);
                                    echo form_close();
                                    ?>
                                    <div class="form-group<?php if(isset($eMsg['wrongphoneformat'])||isset($eMsg['oldvip'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">联系电话</label>
                                        <div class="col-lg-10">
                                            <input form="addVip" class="form-control" type="tel" name="vipPhone" <?php if(isset($_SESSION['error']['uphone'])){$phone = $_SESSION['error']['uphone'];echo "value=$phone";}?>/>
                                            <?php
                                            if(isset($eMsg['oldvip'])){
                                                echo '<span class="help-block">'.$eMsg['oldvip'].'</span>';
                                            }elseif(isset($eMsg['wrongphoneformat'])){
                                                echo '<span class="help-block">'.$eMsg['wrongphoneformat'].'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['emptycard'])||isset($eMsg['nocard'])||isset($eMsg['inuse'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">会员卡号</label>
                                        <div class="col-lg-10">
                                            <input form="addVip" class="form-control" type="text" name="vipNumber" <?php if(isset($_SESSION['error']['vnumber'])){$number = $_SESSION['error']['vnumber'];echo "value=$number";}?>/>
                                            <?php
                                            if(isset($eMsg['emptycard'])){
                                                echo '<span class="help-block">'.$eMsg['emptycard'].'</span>';
                                            }elseif(isset($eMsg['nocard'])){
                                                echo '<span class="help-block">'.$eMsg['nocard'].'</span>';
                                            }elseif(isset($eMsg['inuse'])){
                                                echo '<span class="help-block">'.$eMsg['inuse'].'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['wrongbalance'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">会员卡面额</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-bottom-right-radius:0px;border-top-right-radius: 0px; ">$</span>
                                                <input form="addVip" class="form-control" type="text" name="vipBalance" <?php if(isset($_SESSION['error']['vbalance'])){$balance = $_SESSION['error']['vbalance'];echo "value=$balance";}?>/>
                                            </div>
                                            <?php
                                            if(isset($eMsg['wrongbalance'])){
                                                echo '<span class="help-block">'.$eMsg['wrongbalance'].'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <button form="addVip" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 确认添加</i>
                                    </button>
                                    <?php
                                    $attributes = array('class'=>'btn btn-success','type'=>'reset');
                                    echo anchor('vipcontroller/goback','<i class="glyphicon glyphicon-backward"> 回VIP列表</i>',$attributes);
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

