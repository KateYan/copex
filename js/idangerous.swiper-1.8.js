Swiper=function(a,b){function e(a){return document.querySelectorAll(a)}function u(){var a=m-k*b.slidesPerSlide;return b.loop&&(a-=p),b.scrollContainer&&(a=k-p,0>a&&(a=0)),a}function A(a){f.allowLinks||a.preventDefault()}function B(a){var c,d,e;return f.isTouched||b.onlyExternal?!1:(f.isTouched=!0,f.support.touch&&1!=a.targetTouches.length||(f.callPlugins("onTouchStartBegin"),b.loop&&f.fixLoop(),f.support.touch||(a.preventDefault?a.preventDefault():a.returnValue=!1),c=f.support.touch?a.targetTouches[0].pageX:a.pageX||a.clientX,d=f.support.touch?a.targetTouches[0].pageY:a.pageY||a.clientY,f.touches.startX=f.touches.currentX=c,f.touches.startY=f.touches.currentY=d,f.touches.start=f.touches.current=j?f.touches.startX:f.touches.startY,f.setTransition(0),f.positions.start=f.positions.current=j?f.getTranslate("x"):f.getTranslate("y"),j?f.setTransform(f.positions.start,0,0):f.setTransform(0,f.positions.start,0),e=new Date,f.times.start=e.getTime(),o=void 0,(b.onSlideClick||b.onSlideTouch)&&function(){var h,i,l,m,n,a=f.container,e=a.getBoundingClientRect(),g=document.body;clientTop=a.clientTop||g.clientTop||0,clientLeft=a.clientLeft||g.clientLeft||0,scrollTop=window.pageYOffset||a.scrollTop,scrollLeft=window.pageXOffset||a.scrollLeft,h=c-e.left+clientLeft-scrollLeft,i=d-e.top-clientTop-scrollTop,l=j?h:i,m=-Math.round(f.positions.current/k),n=Math.floor(l/k)+m,b.loop&&(n-=b.slidesPerSlide,0>n&&(n=f.slides.length+n-2*b.slidesPerSlide)),f.clickedSlideIndex=n,f.clickedSlide=f.getSlide(n),b.onSlideTouch&&(b.onSlideTouch(f),f.callPlugins("onSlideTouch"))}(),b.onTouchStart&&b.onTouchStart(f),f.callPlugins("onTouchStartEnd")),void 0)}function C(a){var c,d,e,g,h,i;if(f.isTouched&&!b.onlyExternal&&(c=f.support.touch?a.targetTouches[0].pageX:a.pageX||a.clientX,d=f.support.touch?a.targetTouches[0].pageY:a.pageY||a.clientY,"undefined"==typeof o&&j&&(o=!!(o||Math.abs(d-f.touches.startY)>Math.abs(c-f.touches.startX))),"undefined"!=typeof o||j||(o=!!(o||Math.abs(d-f.touches.startY)<Math.abs(c-f.touches.startX))),!o)){if(a.assignedToSwiper)return f.isTouched=!1,void 0;if(a.assignedToSwiper=!0,b.preventLinks&&(f.allowLinks=!1),b.autoPlay&&f.stopAutoPlay(),!f.support.touch||1==a.touches.length){if(f.callPlugins("onTouchMoveStart"),a.preventDefault?a.preventDefault():a.returnValue=!1,f.touches.current=j?c:d,f.positions.current=(f.touches.current-f.touches.start)*b.ratio+f.positions.start,b.resistance&&(f.positions.current>0&&(!b.freeMode||b.freeModeFluid)&&(b.loop?(e=1,f.positions.current>0&&(f.positions.current=0)):e=(2*p-f.positions.current)/p/2,f.positions.current=.5>e?p/2:f.positions.current*e),f.positions.current<-u()&&(!b.freeMode||b.freeModeFluid)&&(b.loop?(e=1,g=f.positions.current,h=-u()-p):(i=(f.touches.current-f.touches.start)*b.ratio+(u()+f.positions.start),e=(p+i)/p,g=f.positions.current-i*(1-e)/2,h=-u()-p/2),f.positions.current=h>g||0>=e?h:g)),!b.followFinger)return;return j?f.setTransform(f.positions.current,0,0):f.setTransform(0,f.positions.current,0),b.freeMode&&f.updateActiveSlide(f.positions.current),b.onTouchMove&&b.onTouchMove(f),f.callPlugins("onTouchMoveEnd"),!1}}}function D(a){var c,d,e,g,h,i;if(!b.onlyExternal&&f.isTouched){if(f.isTouched=!1,b.preventLinks&&(c=!0,setTimeout(function(){var d,e,g,h,i,j;if(a||window.event,f.allowLinks=!0,""!=!idCode)return!1;if(d=document.getElementById(idCode),e=d.style.transform,g=/^translate3d\(0px,\s-?(\d+)px,\s0px\)$/,h=g.exec(e),null!=h&&(i=h[1],j=i/44,$("#"+idCode+" .swiper-slide").eq(j+1).addClass("clickThisTime").siblings().removeClass("clickThisTime"),$(".firstDiv .swiper-slide").eq(j).addClass("clickThisTime").siblings().removeClass("clickThisTime"),c=!1,"swiper-citydefault"==idCode)){if(44==i)return loadCitys("citys.html",1,null),void 0;if(0==i)return loadCity("citydefault.html",0,null),void 0}},20),c&&$(".firstDiv .swiper-slide").eq(0).addClass("clickThisTime").siblings().removeClass("clickThisTime")),b.onSlideClick&&(b.onSlideClick(f),f.callPlugins("onSlideClick")),f.positions.current||0===f.positions.current||(f.positions.current=f.positions.start),j?f.setTransform(f.positions.current,0,0):f.setTransform(0,f.positions.current,0),d=new Date,f.times.end=d.getTime(),f.touches.diff=f.touches.current-f.touches.start,f.touches.abs=Math.abs(f.touches.diff),f.positions.diff=f.positions.current-f.positions.start,f.positions.abs=Math.abs(f.positions.diff),e=f.positions.diff,g=f.positions.abs,5>g&&f.swipeReset(),h=m-k*b.slidesPerSlide,b.scrollContainer&&(h=k-p),f.positions.current>0)return f.swipeReset(),b.onTouchEnd&&b.onTouchEnd(f),f.callPlugins("onTouchEnd"),void 0;if(f.positions.current<-h)return f.swipeReset(),b.onTouchEnd&&b.onTouchEnd(f),f.callPlugins("onTouchEnd"),void 0;if(b.freeMode)return f.times.end-f.times.start<300&&b.freeModeFluid&&(i=f.positions.current+2*f.touches.diff,-1*h>i&&(i=-h),i>0&&(i=0),j?f.setTransform(i,0,0):f.setTransform(0,i,0),f.setTransition(2*(f.times.end-f.times.start)),f.updateActiveSlide(i)),(!b.freeModeFluid||f.times.end-f.times.start>=300)&&f.updateActiveSlide(f.positions.current),b.onTouchEnd&&b.onTouchEnd(f),f.callPlugins("onTouchEnd"),void 0;n=0>e?"toNext":"toPrev","toNext"==n&&f.times.end-f.times.start<=300&&(30>g?f.swipeReset():f.swipeNext(!0)),"toPrev"==n&&f.times.end-f.times.start<=300&&(30>g?f.swipeReset():f.swipePrev(!0)),"toNext"==n&&f.times.end-f.times.start>300&&(g>=.5*k?f.swipeNext(!0):f.swipeReset()),"toPrev"==n&&f.times.end-f.times.start>300&&(g>=.5*k?f.swipePrev(!0):f.swipeReset()),b.onTouchEnd&&b.onTouchEnd(f),f.callPlugins("onTouchEnd")}}function F(){f.callPlugins("onSlideChangeStart"),b.onSlideChangeStart&&b.onSlideChangeStart(f),b.onSlideChangeEnd&&f.transitionEnd(b.onSlideChangeEnd)}var d,f,g,h,j,k,l,m,n,o,p,i,q,r,s,t,w,x,y,z,E;if(window.addEventListener||(window.Element||(Element=function(){}),Element.prototype.addEventListener=HTMLDocument.prototype.addEventListener=addEventListener=function(a,b){this.attachEvent("on"+a,b)},Element.prototype.removeEventListener=HTMLDocument.prototype.removeEventListener=removeEventListener=function(a,b){this.detachEvent("on"+a,b)}),document.body.__defineGetter__&&HTMLElement&&(d=HTMLElement.prototype,d.__defineGetter__&&d.__defineGetter__("outerHTML",function(){return(new XMLSerializer).serializeToString(this)})),window.getComputedStyle||(window.getComputedStyle=function(a){return this.el=a,this.getPropertyValue=function(b){var c=/(\-([a-z]){1})/g;return"float"==b&&(b="styleFloat"),c.test(b)&&(b=b.replace(c,function(){return arguments[2].toUpperCase()})),a.currentStyle[b]?a.currentStyle[b]:null},this}),document.querySelectorAll&&0!=document.querySelectorAll(a).length){f=this,f.touches={},f.positions={current:0},f.id=(new Date).getTime(),f.container=e(a)[0],f.times={},f.isTouched=!1,f.realIndex=0,f.activeSlide=0,f.previousSlide=null,f.support={touch:f.isSupportTouch(),threeD:f.isSupport3D()},f.use3D=f.support.threeD,g={mode:"horizontal",ratio:1,speed:300,freeMode:!1,freeModeFluid:!1,slidesPerSlide:1,simulateTouch:!0,followFinger:!0,autoPlay:!1,onlyExternal:!1,createPagination:!0,pagination:!1,resistance:!0,scrollContainer:!1,preventLinks:!0,initialSlide:0,slideClass:"swiper-slide",wrapperClass:"swiper-wrapper",paginationClass:"swiper-pagination-switch",paginationActiveClass:"swiper-active-switch"},b=b||{};for(h in g)h in b||(b[h]=g[h]);f.params=b,b.scrollContainer&&(b.freeMode=!0,b.freeModeFluid=!0),i=e(a+" ."+b.wrapperClass).item(0),f.wrapper=i,j="horizontal"==b.mode,f.touchEvents={touchStart:f.support.touch||!b.simulateTouch?"touchstart":f.ie10?"MSPointerDown":"mousedown",touchMove:f.support.touch||!b.simulateTouch?"touchmove":f.ie10?"MSPointerMove":"mousemove",touchEnd:f.support.touch||!b.simulateTouch?"touchend":f.ie10?"MSPointerUp":"mouseup"},f._extendSwiperSlide=function(c){return c.append=function(){return f.wrapper.appendChild(c),f.reInit(),c},c.prepend=function(){return f.wrapper.insertBefore(c,f.wrapper.firstChild),f.reInit(),c},c.insertAfter=function(d){if(void 0===typeof d)return!1;var g=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass+":nth-child("+(d+2)+")")[0];return f.wrapper.insertBefore(c,g),f.reInit(),c},c.clone=function(){return f._extendSwiperSlide(c.cloneNode(!0))},c.remove=function(){f.wrapper.removeChild(c),f.reInit()},c.html=function(a){return void 0==typeof a?c.innerHTML:(c.innerHTML=a,c)},c.index=function(){var a,b;for(b=f.slides.length-1;b>=0;b--)c==f.slides[b]&&(a=b);return a},c.isActive=function(){return c.index()==f.activeSlide?!0:!1},c.swiperSlideDataStorage||(c.swiperSlideDataStorage={}),c.getData=function(a){return c.swiperSlideDataStorage[a]},c.setData=function(a,b){return c.swiperSlideDataStorage[a]=b,c},c.data=function(a,b){return b?(c.setAttribute("data-"+a,b),c):c.getAttribute("data-"+a)},c},f._calcSlides=function(){var d,c=f.slides?f.slides.length:!1;for(f.slides=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass),d=f.slides.length-1;d>=0;d--)f._extendSwiperSlide(f.slides[d]);c&&c!=f.slides.length&&f.createPagination&&(f.createPagination(),f.callPlugins("numberOfSlidesChanged"))},f._calcSlides(),f.createSlide=function(a,b,c){var d;return b=b||f.params.slideClass,d=document.createElement("div"),d.innerHTML=a||"",d.className=b,f._extendSwiperSlide(d)},f.appendSlide=function(a,b,c){return a?a instanceof HTMLElement?f._extendSwiperSlide(a).append():f.createSlide(a,b,c).append():void 0},f.prependSlide=function(a,b,c){return a?a instanceof HTMLElement?f._extendSwiperSlide(a).prepend():f.createSlide(a,b,c).prepend():void 0},f.insertSlideAfter=function(a,b,c,d){return a?a instanceof HTMLElement?f._extendSwiperSlide(a).insertAfter(a):f.createSlide(b,c,d).insertAfter(a):!1},f.removeSlide=function(a){return f.slides[a]?(f.slides[a].remove(),!0):!1},f.removeLastSlide=function(){return f.slides.length>0?(f.slides[f.slides.length-1].remove(),!0):!1},f.removeAllSlides=function(){for(var a=f.slides.length-1;a>=0;a--)f.slides[a].remove()},f.getSlide=function(a){return f.slides[a]},f.getLastSlide=function(){return f.slides[f.slides.length-1]},f.getFirstSlide=function(){return f.slides[0]},f.currentSlide=function(){return f.slides[f.activeSlide]},q=[];for(r in f.plugins)b[r]&&(s=f.plugins[r](f,b[r]),s&&q.push(s));if(f.callPlugins=function(a,b){b||(b={});for(var c=0;c<q.length;c++)a in q[c]&&q[c][a](b)},f.ie10&&!b.onlyExternal&&(j?f.wrapper.classList.add("swiper-wp8-horizontal"):f.wrapper.classList.add("swiper-wp8-vertical")),b.loop&&function(){var c,d,g;for(l=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass).length,c="",d="",g=0;g<b.slidesPerSlide;g++)c+=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass).item(g).outerHTML;for(g=l-b.slidesPerSlide;l>g;g++)d+=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass).item(g).outerHTML;i.innerHTML=d+i.innerHTML+c,f._calcSlides(),f.callPlugins("onCreateLoop")}(),t=!1,f.init=function(c){var o,q,r,s,h,n,u,v,d=parseInt(window.getComputedStyle(f.container,null).getPropertyValue("width"),10),g=parseInt(window.getComputedStyle(f.container,null).getPropertyValue("height"),10);if(isNaN(d)&&(d=f.container.offsetWidth-parseInt(window.getComputedStyle(f.container,null).getPropertyValue("padding-left"),10)-parseInt(window.getComputedStyle(f.container,null).getPropertyValue("padding-right"),10)),isNaN(g)&&(g=f.container.offsetHeight-parseInt(window.getComputedStyle(f.container,null).getPropertyValue("padding-top"),10)-parseInt(window.getComputedStyle(f.container,null).getPropertyValue("padding-bottom"),10)),c||f.width!=d||f.height!=g){for((c||t)&&f._calcSlides(),f.width=d,f.height=g,h=j?1:b.slidesPerSlide,n=j?b.slidesPerSlide:1,l=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass).length,b.scrollContainer?(o=e(a+" ."+b.slideClass).item(0).offsetWidth,q=e(a+" ."+b.slideClass).item(0).offsetHeight,p=j?f.width:f.height,k=j?o:q,r=o,s=q):(o=f.width/n,q=f.height/h,k=p=j?f.width:f.height,r=j?l*f.width/n:f.width,s=j?f.height:l*f.height/h),m=j?r:s,u=0;l>u;u++)v=e(a+" > ."+b.wrapperClass+" > ."+b.slideClass).item(u),v.style.width=o+"px",v.style.height=q+"px",b.onSlideInitialize&&b.onSlideInitialize(f,v);i.style.width=r+"px",i.style.height=s+"px",b.initialSlide>0&&b.initialSlide<l&&(f.realIndex=f.activeSlide=b.initialSlide,f.params.loop&&(f.activeSlide=f.realIndex-b.slidesPerSlide),j?(f.positions.current=-b.initialSlide*o,f.setTransform(f.positions.current,0,0)):(f.positions.current=-b.initialSlide*q,f.setTransform(0,f.positions.current,0))),b.slidesPerSlide&&b.slidesPerSlide>1&&(k/=b.slidesPerSlide),t?f.callPlugins("onInit"):f.callPlugins("onFirstInit"),t=!0}},f.init(),f.reInit=function(){f.init(!0)},f.updatePagination=function(){var a,c,d,g,h,i;if(!(f.slides.length<2)&&(a=e(b.pagination+" ."+b.paginationActiveClass))){for(c=0;c<a.length;c++)a.item(c).className.indexOf("active")>=0&&(a.item(c).className=a.item(c).className.replace(b.paginationActiveClass,""));for(d=e(b.pagination+" ."+b.paginationClass).length,g=b.loop?f.realIndex-b.slidesPerSlide:f.realIndex,h=g+(b.slidesPerSlide-1),c=g;h>=c;c++)i=c,i>=d&&(i-=d),0>i&&(i=d+i),l>i&&(e(b.pagination+" ."+b.paginationClass).item(i).className=e(b.pagination+" ."+b.paginationClass).item(i).className+" "+b.paginationActiveClass)}},f.createPagination=function(){var a,c,d,g;if(b.pagination&&b.createPagination){for(a="",c=f.slides.length,d=b.loop?c-2*b.slidesPerSlide:c,g=0;d>g;g++)a+='<span class="'+b.paginationClass+'"></span>';e(b.pagination)[0].innerHTML=a,f.updatePagination(),f.callPlugins("onCreatePagination")}},f.createPagination(),f.resizeEvent="resize","onorientationchange"in window&&(f.resizeEvent="orientationchange"),f.resizeFix=function(){var a,c,d;f.callPlugins("beforeResizeFix"),f.init(),b.scrollContainer?(a=j?f.getTranslate("x"):f.getTranslate("y"),a<-u()&&(c=j?-u():0,d=j?0:-u(),f.setTransition(0),f.setTransform(c,d,0))):f.swipeTo(f.activeSlide,0,!1),f.callPlugins("afterResizeFix")},b.disableAutoResize||window.addEventListener(f.resizeEvent,f.resizeFix,!1),f.startAutoPlay=function(){b.autoPlay&&!b.loop?w=setInterval(function(){var a=f.realIndex+1;a==l&&(a=0),f.swipeTo(a)},b.autoPlay):b.autoPlay&&b.loop&&(w=setInterval(function(){f.swipeNext()},b.autoPlay)),f.callPlugins("onAutoPlayStart")},f.stopAutoPlay=function(){w&&clearInterval(w),f.callPlugins("onAutoPlayStop")},b.autoPlay&&f.startAutoPlay(),i.addEventListener(f.touchEvents.touchStart,B,!1),x=f.support.touch?i:document,x.addEventListener(f.touchEvents.touchMove,C,!1),x.addEventListener(f.touchEvents.touchEnd,D,!1),f.destroy=function(a){a=a===!1?a:a||!0,a&&window.removeEventListener(f.resizeEvent,f.resizeFix,!1),i.removeEventListener(f.touchEvents.touchStart,B,!0),x.removeEventListener(f.touchEvents.touchMove,C,!0),x.removeEventListener(f.touchEvents.touchEnd,D,!0),f.callPlugins("onDestroy")},f.allowLinks=!0,b.preventLinks)for(y=f.container.querySelectorAll("a"),z=0;z<y.length;z++)y[z].addEventListener("click",A,!1);f.swipeNext=function(a){var c,d;return!a&&b.loop&&f.fixLoop(),f.callPlugins("onSwipeNext"),c=j?f.getTranslate("x"):f.getTranslate("y"),d=Math.floor(Math.abs(c)/Math.floor(k))*k+k,d==m||d>u()&&!b.loop?void 0:(b.loop&&d>=u()+p&&(d=u()+p),j?f.setTransform(-d,0,0):f.setTransform(0,-d,0),f.setTransition(b.speed),f.updateActiveSlide(-d),F(),!0)},f.swipePrev=function(a){var c,d;return!a&&b.loop&&f.fixLoop(),f.callPlugins("onSwipePrev"),c=j?f.getTranslate("x"):f.getTranslate("y"),d=(Math.ceil(-c/k)-1)*k,0>d&&(d=0),j?f.setTransform(-d,0,0):f.setTransform(0,-d,0),f.setTransition(b.speed),f.updateActiveSlide(-d),F(),!0},f.swipeReset=function(){var c,d,e;return f.callPlugins("onSwipeReset"),c=j?f.getTranslate("x"):f.getTranslate("y"),d=0>c?Math.round(c/k)*k:0,e=-u(),b.scrollContainer&&(d=0>c?c:0,e=p-k),e>=d&&(d=e),b.scrollContainer&&p>k&&(d=0),"horizontal"==b.mode?f.setTransform(d,0,0):f.setTransform(0,d,0),f.setTransition(b.speed),f.updateActiveSlide(d),b.onSlideReset&&b.onSlideReset(f),!0},E=!0,f.swipeTo=function(a,c,d){var e;return a=parseInt(a,10),f.callPlugins("onSwipeTo",{index:a,speed:c}),a>l-1||0>a&&!b.loop?void 0:(d=d===!1?!1:d||!0,c=0===c?c:c||b.speed,b.loop&&(a+=b.slidesPerSlide),a>l-b.slidesPerSlide&&(a=l-b.slidesPerSlide),e=-a*k,E&&b.loop&&b.initialSlide>0&&b.initialSlide<l&&(e-=b.initialSlide*k,E=!1),j?f.setTransform(e,0,0):f.setTransform(0,e,0),f.setTransition(c),f.updateActiveSlide(e),d&&F(),!0)},f.updateActiveSlide=function(a){f.previousSlide=f.realIndex,f.realIndex=Math.round(-a/k),b.loop?(f.activeSlide=f.realIndex-b.slidesPerSlide,f.activeSlide>=l-2*b.slidesPerSlide&&(f.activeSlide=l-2*b.slidesPerSlide-f.activeSlide),f.activeSlide<0&&(f.activeSlide=l-2*b.slidesPerSlide+f.activeSlide)):f.activeSlide=f.realIndex,f.realIndex==l&&(f.realIndex=l-1),f.realIndex<0&&(f.realIndex=0),b.pagination&&f.updatePagination()},f.fixLoop=function(){var a;f.realIndex<b.slidesPerSlide&&(a=l-3*b.slidesPerSlide+f.realIndex,f.swipeTo(a,0,!1)),f.realIndex>l-2*b.slidesPerSlide&&(a=-l+f.realIndex+b.slidesPerSlide,f.swipeTo(a,0,!1))},b.loop&&f.swipeTo(0,0,!1)}},Swiper.prototype={plugins:{},transitionEnd:function(a){function e(){a(b);for(var f=0;f<d.length;f++)c.removeEventListener(d[f],e,!1)}var f,b=this,c=b.wrapper,d=["webkitTransitionEnd","transitionend","oTransitionEnd","MSTransitionEnd","msTransitionEnd"];if(a)for(f=0;f<d.length;f++)c.addEventListener(d[f],e,!1)},isSupportTouch:function(){return"ontouchstart"in window||window.DocumentTouch&&document instanceof DocumentTouch},isSupport3D:function(){var b,c,a=document.createElement("div");return a.id="test3d",b=!1,"webkitPerspective"in a.style&&(b=!0),"MozPerspective"in a.style&&(b=!0),"OPerspective"in a.style&&(b=!0),"MsPerspective"in a.style&&(b=!0),"perspective"in a.style&&(b=!0),b&&"webkitPerspective"in a.style&&(c=document.createElement("style"),c.textContent="@media (-webkit-transform-3d), (transform-3d), (-moz-transform-3d), (-o-transform-3d), (-ms-transform-3d) {#test3d{height:5px}}",document.getElementsByTagName("head")[0].appendChild(c),document.body.appendChild(a),b=5===a.offsetHeight,c.parentNode.removeChild(c),a.parentNode.removeChild(a)),b},getTranslate:function(a){var c,d,e,b=this.wrapper;return window.WebKitCSSMatrix?(e=new WebKitCSSMatrix(window.getComputedStyle(b,null).webkitTransform),c=e.toString().split(",")):(e=window.getComputedStyle(b,null).MozTransform||window.getComputedStyle(b,null).OTransform||window.getComputedStyle(b,null).MsTransform||window.getComputedStyle(b,null).msTransform||window.getComputedStyle(b,null).transform||window.getComputedStyle(b,null).getPropertyValue("transform").replace("translate(","matrix(1, 0, 0, 1,"),c=e.toString().split(",")),"x"==a&&(d=16==c.length?parseInt(c[12],10):parseInt(c[4],10)),"y"==a&&(d=16==c.length?parseInt(c[13],10):parseInt(c[5],10)),d},setTransform:function(a,b,c){var d=this.wrapper.style;a=a||0,b=b||0,c=c||0,this.support.threeD?d.webkitTransform=d.MsTransform=d.msTransform=d.MozTransform=d.OTransform=d.transform="translate3d("+a+"px, "+b+"px, "+c+"px)":(d.webkitTransform=d.MsTransform=d.msTransform=d.MozTransform=d.OTransform=d.transform="translate("+a+"px, "+b+"px)",this.ie8&&(d.left=a+"px",d.top=b+"px")),this.callPlugins("onSetTransform",{x:a,y:b,z:c})},setTransition:function(a){var b=this.wrapper.style;b.webkitTransitionDuration=b.MsTransitionDuration=b.msTransitionDuration=b.MozTransitionDuration=b.OTransitionDuration=b.transitionDuration=a/1e3+"s",this.callPlugins("onSetTransition",{duration:a})},ie8:function(){var b,c,a=-1;return"Microsoft Internet Explorer"==navigator.appName&&(b=navigator.userAgent,c=new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})"),null!=c.exec(b)&&(a=parseFloat(RegExp.$1))),-1!=a&&9>a}(),ie10:window.navigator.msPointerEnabled},(window.jQuery||window.Zepto)&&function(a){a.fn.swiper=function(b){var c=new Swiper(a(this).selector,b);return a(this).data("swiper",c),c}}(window.jQuery||window.Zepto);