<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>选择你所在的校区</title>
    <link href="http://localhost/copex/css/masterpage.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/copex/css/dinner.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
    $attributes=array('class'=>'formcontrol','id'=>'campus');
echo form_open('userstatuscontroller/campusCookie',$attributes);
?>
<ul>
    <?php
    foreach($result as $campus){
        echo '<li>';
        echo '<span>';
        echo '<input type="checkbox" name="cid" value="'.$campus->cid.'">';
        echo '<a>'.$campus->cname.'</a>';
        echo '</span>';
        echo '</li>';
    }
    ?>
</ul>
<button>去看看</button>
</body>
<?php
/**
 * Created by PhpStorm.
 * User: cecil_000
 * Date: 12/1/2014
 * Time: 5:53 PM
 */ 