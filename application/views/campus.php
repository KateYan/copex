<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:53 PM
 */
?>
    <!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Cache-control" />
    <meta name="format-detection" content="telephone=no" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="width=device-width; maximum-scale=1.0;  user-scalable=no; initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <link href="../../css/masterpage.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../js/jquery-1.7.2.min.js"></script>
</head>
<body>
<?php
    $attributes=array('class'=>'formcontrol','id'=>'campus');
echo form_open('userlogincontroller/setUser',$attributes);
?>
<ul>
    <?php
    foreach($result as $campus){
        echo '<li>';
        echo '<span>';
        echo '<input type="radio" name="cid" value="'.$campus->cid.'">';
        echo '<a>'.$campus->cname.'</a>';
        echo '</span>';
        echo '</li>';
    }
    ?>
</ul>
<button>去看看</button>
</body>
<?php
