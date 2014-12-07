<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 12/1/2014
 * Time: 5:53 PM
 */
?>
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
