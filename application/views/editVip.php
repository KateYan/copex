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
                            <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo $username; ?> <i class="caret"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">更改用户名</a></li>
                                <li><a href="#">更改登录密码</a></li>
                                <li role="presentation" class="divider"></li>
                                <li>
                                    <?php
                                    $attributes = array('class'=>'log_out');
                                    echo anchor('admincontroller/showAdminLogin','退出登录',$attributes);
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
                <div class="text-muted bootstrap-admin-box-title">编辑会员</div>
            </div>
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <form class="form-horizontal">
                    <fieldset>
                        <legend>会员信息</legend>
                        <?php
                        $attributes = array('id'=>'editVip');
                        echo form_open('vipcontroller/editVip',$attributes);
                        echo form_close();
                        ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="focusedInput">用户所在校区</label>
                            <div class="col-lg-10">
                                <?php
                                foreach($campus as $campus_choose){
                                    echo '<label style="padding-right: 15px;">';
                                    echo '<input form="editVip"';
                                    if($campus_choose->cid==$vipUser->cid){
                                        echo "checked";
                                    }
                                    echo ' type="radio" name="campusId" value="'.$campus_choose->cid.'"/>';
                                    echo "  ".$campus_choose->cname;
                                    echo '</label>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">联系电话</label>
                            <div class="col-lg-10">
                                <input form="editVip" class="form-control" type="text" name="vipPhone" value="<?php echo $vipUser->uphone; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">会员卡号</label>
                            <div class="col-lg-10">
                                <input form="editVip" class="form-control" type="text" name="vipNumber" value="<?php echo $vipUser->vnumber; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">会员卡余额</label>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon" style="border-bottom-right-radius:0px;border-top-right-radius: 0px; ">$</span>
                                <input form="editVip" class="form-control" type="text" name="vipBalance" value="<?php echo $vipUser->vbalance; ?>"/>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">重置会员支付密码</label>
                            <div class="col-lg-10">
                                <input form="editVip" class="form-control" type="password" name="newPassword" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">再次输入重置密码</label>
                            <div class="col-lg-10">
                                <input form="editVip" class="form-control" type="password" name="checkNewPassword" />
                            </div>
                        </div>
                        <div class="form-group has-error">
                            <label class="col-lg-2 control-label" for="inputError">Input with error</label>
                            <div class="col-lg-10">
                                <input type="text" id="inputError" class="form-control">
                                <span class="help-block">Please correct the error</span>
                            </div>
                        </div>
                        <button form="editVip" type="submit" class="btn btn-primary">
                            <i class="glyphicon glyphicon-inbox"> 保存修改</i>
                        </button>
                        <a type="reset" href="../showEditVip/<?php echo $vipUser->uid;?>" class="btn btn-default">
                            <i class="glyphicon glyphicon-refresh"> 取消修改</i>
                        </a>
                        <a type="reset" href="../showVipPanel" class="btn btn-success">
                            <i class="glyphicon glyphicon-backward"> 回VIP列表</i>
                        </a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- footer -->
<div class="navbar navbar-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <footer role="contentinfo">
                    <p class="left">Copex 订餐管理系统</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="vendors/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="vendors/chosen.jquery.min.js"></script>
<script type="text/javascript" src="vendors/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript" src="vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>
<script type="text/javascript" src="vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>
<script type="text/javascript" src="vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>
<script type="text/javascript" src="vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
    $(function() {
        $('.datepicker').datepicker();
        $('.uniform_on').uniform();
        $('.chzn-select').chosen();
        $('.selectize-select').selectize();
        $('.textarea-wysihtml5').wysihtml5({
            stylesheets: [
                'vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/stylesheets/bootstrap-wysihtml5/wysiwyg-color.css'
            ]
        });

        $('#rootwizard').bootstrapWizard({
            'nextSelector': '.next',
            'previousSelector': '.previous',
            onNext: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            },
            onPrevious: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#rootwizard').find('.progress-bar').css('width', $percent + '%');
                // If it's the last tab then hide the last button and show the finish instead
                if ($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            },
            onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index + 1;
                var $percent = ($current / $total) * 100;
                $('#rootwizard').find('.bar').css({width: $percent + '%'});
            }
        });
        $('#rootwizard .finish').click(function() {
            alert('Finished!, Starting over!');
            $('#rootwizard').find('a[href*=\'tab1\']').trigger('click');
        });
    });
</script>
</body>
</html>
