<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/10/2015
 * Time: 6:10 PM
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
                        <h1>会员卡管理</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default bootstrap-admin-no-table-panel">
                        <div class="panel-heading">
                            <div class="text-muted bootstrap-admin-box-title">添加新会员卡

                                <?php
                                if(isset($eMsg['success'])){
                                    echo '<span style="color: #be2221; "><b>'.$eMsg['success'].'</b></span>';
                                }

                                $attributes = array('class'=>'btn btn-sm btn-warning','type'=>'reset','style'=>'float:right;margin-top:0px;');
                                echo anchor('cardcontroller/goback','<i class="glyphicon glyphicon-backward"> 回会员卡列表</i>',$attributes);
                                ?>
                            </div>
                        </div>
                        <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                            <div class="form-horizontal">
                                <fieldset>
                                    <legend>会员卡信息</legend>
                                    <?php
                                    $attributes = array('id'=>'addCard');
                                    echo form_open('cardcontroller/addCard',$attributes);
                                    echo form_close();
                                    ?>

                                    <div class="form-group<?php if(isset($eMsg['wrong'])||isset($eMsg['wrongpass'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">会员卡号</label>
                                        <div class="col-lg-10">
                                            <input form="addCard" class="form-control" type="text" name="vipNumber" required/>
                                            <?php
                                            if(isset($eMsg['wrong'])){
                                                echo '<span class="help-block">'."请输入4位有效数字作为会员卡号".'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['wrong'])||isset($eMsg['wrongpass'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">会员卡余额</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-bottom-right-radius:0px;border-top-right-radius: 0px; ">$</span>
                                                <input form="addCard" class="form-control" type="text" name="vipBalance" required/>
                                            </div>
                                            <?php
                                            if(isset($eMsg['wrong'])){
                                                echo '<span class="help-block">'."请输入50-300的会员卡余额".'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['pswmiss'])||isset($eMsg['wrongpass'])||isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">支付密码</label>
                                        <div class="col-lg-10">
                                            <input form="addCard" class="form-control" type="password" name="newPassword" required />
                                            <?php
                                            if(isset($eMsg['wrong'])){
                                                echo '<span class="help-block">'."输入不含除数字/字母/下划线/破折号以外其他字符的6-10位密码".'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group<?php if(isset($eMsg['pswnotmatch'])||isset($eMsg['wrong'])){echo " has-error";}?>">
                                        <label class="col-lg-2 control-label">再次输入支付密码</label>
                                        <div class="col-lg-10">
                                            <input form="addCard" class="form-control" type="password" name="checkNewPassword" required />
                                            <?php
                                            if(isset($eMsg['pswnotmatch'])){
                                                echo '<span class="help-block">'.$eMsg['pswnotmatch'].'</span>';
                                            }elseif(isset($eMsg['pswnotmatch'])){
                                                echo '<span class="help-block">'."输入不含除数字/字母/下划线/破折号以外其他字符的6-10位密码".'</span>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <button form="addCard" type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                                    </button>
                                    <?php
                                    $attributes = array('class'=>'btn btn-default','type'=>'reset','style'=>'margin-right:5px;');
                                    echo anchor("cardcontroller/addCard",'<i class="glyphicon glyphicon-refresh"> 取消修改</i>',$attributes);

                                    $attributes = array('class'=>'btn btn-success','type'=>'reset');
                                    echo anchor('cardcontroller/goback','<i class="glyphicon glyphicon-backward"> 回会员卡列表</i>',$attributes);
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

