<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/19/2014
 * Time: 1:53 PM
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
            <h1>订单详情</h1>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">订单详情</div>
            </div>
            <div class="bootstrap-admin-panel-content">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>校区</th>
                        <th>用户</th>
                        <th>用户类型</th>
                        <th>用户电话</th>
                        <th>取餐日期</th>
                        <th>下单时间</th>
                        <th>菜品</th>
                        <th>菜品类型</th>
                        <th>单价</th>
                        <th>货源餐厅</th>
                        <th>已付款?</th>
                        <th>已收货？</th>
                        <th>税款</th>
                        <th>总价</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!isset($orderFood)){
                        echo "暂时还没有用户点今天的菜，请稍等片刻后刷新看看。";
                    }
                    foreach($orderFood as $order){
                        echo '<tr>';
                        echo '<td><a href="showOrderDetail/'.$order->oid.'">';
                        echo $order->oid;
                        echo '</a></td>';
                        echo '<td>'.$order->cname.'</td>';
                        echo '<td>'.$order->uid.'</td>';
                        if(empty($order->vipid)){
                            echo '<td>'."普通用户".'</td>';
                        }else{
                            echo '<td>'."VIP用户".'</td>';
                        }
                        echo '<td>'.$order->uphone.'</td>';
                        echo '<td>'.$order->fordate.'</td>';
                        echo '<td>'.$order->odate.'</td>';
                        echo '<td>'.$order->fname.'</td>';
                        if($order->dishtype==0){
                            echo '<td>'."主食".'</td>';
                        }elseif($order->dishtype==1){
                            echo '<td>'."小食".'</td>';
                        }else{
                            echo '<td>'."N/A".'</td>';
                        }
                        echo '<td>'."$".$order->fprice.'</td>';
                        echo '<td>'.$order->dname.'</td>';
                        if($order->oispad==0){
                            echo '<td>'."暂未".'</td>';
                        }elseif($order->oispad==1){
                            echo '<td>'."是".'</td>';
                        }else{
                            echo '<td>'."N/A".'</td>';
                        }
                        if($order->ostatus==0){
                            echo '<td>'."暂未".'</td>';
                        }elseif($order->ostatus==1){
                            echo '<td>'."是".'</td>';
                        }else{
                            echo '<td>'."N/A".'</td>';
                        }
                        echo '<td>'.$order->tax.'</td>';
                        echo '<td>'."$".$order->totalcost.'</td>';
                        echo '</tr>';
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
        <div class="panel panel-default bootstrap-admin-no-table-panel">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">Form Example</div>
            </div>
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <form class="form-horizontal">
                    <fieldset>
                        <legend>Form Components</legend>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="typeahead">Text input </label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control col-md-6" id="typeahead" autocomplete="off" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                <p class="help-block">Start typing to activate auto complete!</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="date01">Date input</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control datepicker" id="date01" value="02/16/12">
                                <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="optionsCheckbox">Checkbox</label>
                            <div class="col-lg-10">
                                <label class="uniform">
                                    <input class="uniform_on" type="checkbox" id="optionsCheckbox" value="option1">
                                    Option one is this and that&mdash;be sure to include why it's great
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="select01">With Chosen plugin</label>
                            <div class="col-lg-10">
                                <select id="select01" class="chzn-select" style="width: 150px">
                                    <option>something</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="select02">With Selectize plugin</label>
                            <div class="col-lg-10">
                                <select id="select02" class="selectize-select" style="width: 150px">
                                    <option value="1">something</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="fileInput">File input</label>
                            <div class="col-lg-10">
                                <input class="form-control uniform_on" id="fileInput" type="file">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" for="textarea-wysihtml5">Textarea WYSIWYG</label>
                            <div class="col-lg-10">
                                <textarea id="textarea-wysihtml5" class="form-control textarea-wysihtml5" placeholder="Enter text..." style="width: 100%; height: 200px"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="reset" class="btn btn-default">Cancel</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default bootstrap-admin-no-table-panel">
            <div class="panel-heading">
                <div class="text-muted bootstrap-admin-box-title">Form Wizard</div>
            </div>
            <div class="bootstrap-admin-no-table-panel-content bootstrap-admin-panel-content collapse in">
                <div id="rootwizard">
                    <div class="navbar">
                        <div class="container">
                            <ul>
                                <li><a href="#tab1" data-toggle="tab">Step 1</a></li>
                                <li><a href="#tab2" data-toggle="tab">Step 2</a></li>
                                <li><a href="#tab3" data-toggle="tab">Step 3</a></li>
                            </ul>
                        </div>
                    </div>
                    <div id="bar" class="progress progress-striped active">
                        <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab1">
                            <form class="form-horizontal">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput1">Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput1" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput2">Email</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput2" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput3">Phone</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput3" type="text" value="">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <form class="form-horizontal">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput4">Address</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput4" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput5">City</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput5" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput6">State</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput6" type="text" value="">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <form class="form-horizontal">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput7">Company Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput7" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput8">Contact Name</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput8" type="text" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label" for="focusedInput9">Contact Phone</label>
                                        <div class="col-lg-10">
                                            <input class="form-control" id="focusedInput9" type="text" value="">
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <ul class="pager wizard">
                            <li class="previous first" style="display:none;"><a href="javascript:void(0);">First</a></li>
                            <li class="previous"><a href="javascript:void(0);">Previous</a></li>
                            <li class="next last" style="display:none;"><a href="javascript:void(0);">Last</a></li>
                            <li class="next"><a href="javascript:void(0);">Next</a></li>
                            <li class="next finish" style="display:none;"><a href="javascript:;">Finish</a></li>
                        </ul>
                    </div>
                </div>
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
                    <p class="left">Bootstrap 3.x Admin Theme</p>
                    <p class="right">&copy; 2013 <a href="http://www.meritoo.pl" target="_blank">Meritoo.pl</a></p>
                </footer>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/copex/bootstrap/js/jquery-2.0.3.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/wysihtml5.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/bootstrap-wysihtml5-rails-b3/vendor/assets/javascripts/bootstrap-wysihtml5/core-b3.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/twitter-bootstrap-wizard/jquery.bootstrap.wizard-for.bootstrap3.js"></script>
<script type="text/javascript" src="/copex/bootstrap/vendors/boostrap3-typeahead/bootstrap3-typeahead.min.js"></script>

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
