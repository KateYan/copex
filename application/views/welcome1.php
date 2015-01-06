<?php
/**
 * Created by PhpStorm.
 * User: kunyan
 * Date: 1/6/2015
 * Time: 10:10 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" Content="text/html; charset=utf-8;" />

    <title>移动端触摸滑动</title>
    <meta name="author" content="rainna" />
    <meta name="keywords" content="rainna's js lib" />
    <meta name="description" content="移动端触摸滑动" />
    <meta name="viewport" content="target-densitydpi=320,width=640,user-scalable=no" />

    <style>
        *{margin:0;padding:0;}
        li{list-style:none;}

        .m-slider{width:600px;margin:50px 20px;overflow:hidden;}
        .m-slider .cnt{position:relative;left:0;width:3000px;}
        .m-slider .cnt li{float:left;width:600px;}
        .m-slider .cnt img{display:block;width:100%;height:450px;}
        .m-slider .cnt p{margin:20px 0;}
        .m-slider .icons{text-align:center;color:#000;}
        .m-slider .icons span{margin:0 5px;}
        .m-slider .icons .curr{color:red;}
        .f-anim{-webkit-transition:left .2s linear;}
    </style>
</head>

<body>
<div class="m-slider">
    <ul class="cnt" id="slider">
        <li><img src="/copex/images/remember01.jpg" width="100%" /></li>
        <li><img src="/copex/images/remember02.jpg" width="100%" /></li>
        <li><img src="/copex/images/remember03.jpg" width="100%" /></li>
        <li><img src="/copex/images/remember04.jpg" width="100%" /></li>
        <li>
            <img src="/copex/images/remember05.jpg" width="100%" />
            <?php
            $attributes = array('class'=>'btn_GoIn');
            echo anchor('userlogincontroller/loadCampus','<img src="/copex/images/btn_go.jpg" width="100%" />',$attributes);
            ?>
        </li>
    </ul>

    <div class="icons" id="icons">
        <span class="curr">1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>5</span>
    </div>
</div>

<script>
    var slider = {
        // 判断设备是否支持touch事件
        touch: ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch,
        slider: document.getElementById('slider'),

        // 事件
        events: {
            index: 0,                                       // 显示元素的索引
            slider: this.slider,                            // this为slider对象
            icons: document.getElementById('icons'),
            icon: this.icons.getElementsByTagName('span'),
            handleEvent: function(event) {
                // this指events对象
                var self = this;

                if (event.type == 'touchstart') {
                    self.start(event);
                } else if(event.type == 'touchmove') {
                    self.move(event);
                } else if(event.type == 'touchend') {
                    self.end(event);
                }
            },

            // 滑动开始
            start: function(event) {
                event.preventDefault();                      // 阻止触摸事件的默认动作,即阻止滚屏
                var touch = event.touches[0];                // touches数组对象获得屏幕上所有的touch，取第一个touch
                startPos = {                                 // 取第一个touch的坐标值
                    x: touch.pageX,
                    y: touch.pageY,
                    time: +new Date
                };

                // 绑定事件
                this.slider.addEventListener('touchmove', this, false);
                this.slider.addEventListener('touchend', this, false);
            },

            // 移动
            move: function(event) {
                event.preventDefault();                      // 阻止触摸事件的默认行为，即阻止滚屏

                // 当屏幕有多个touch或者页面被缩放过，就不执行move操作
                if (event.touches.length > 1 || event.scale && event.scale !== 1) return;
                var touch = event.touches[0];
                endPos = {
                    x: touch.pageX - startPos.x,
                    y: touch.pageY - startPos.y
                };

                // 执行操作，使元素移动
                this.slider.className = 'cnt';
                this.slider.style.left = -this.index * 600 + endPos.x + 'px';
            },

            // 滑动释放
            end: function(event) {
                var duration = +new Date - startPos.time;    // 滑动的持续时间

                this.icon[this.index].className = '';
                if (Number(duration) > 100) {
                    // 判断是左移还是右移，当偏移量大于50时执行
                    if (endPos.x > 50) {
                        if(this.index !== 0) this.index -= 1;
                    } else if(endPos.x < -50) {
                        if (this.index !== 4) this.index += 1;
                    }
                }

                this.slider.className = 'cnt f-anim';
                this.slider.style.left = -this.index*600 + 'px';
                this.icon[this.index].className = 'curr';

                // 解绑事件
                this.slider.removeEventListener('touchmove', this, false);
                this.slider.removeEventListener('touchend', this, false);
            }
        },

        // 初始化
        init: function() {
            // this指slider对象
            var self = this;

            // addEventListener第二个参数可以传一个对象，会调用该对象的handleEvent属性
            if(!!self.touch) self.slider.addEventListener('touchstart', self.events, false);
        }
    };

    slider.init();
</script>
</body>
</html>