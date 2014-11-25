
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,user-scalable=yes" />
  <meta content="yes" name="apple-mobile-web-app-capable">
  <meta content="black" name="apple-mobile-web-app-status-bar-style">
  <meta content="telephone=no" name="format-detection">
  <meta content="email=no" name="format-detection">
  <title>摇摇乐</title>
  <link href="../gamecss/main.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../js/zepto.1.1.4.min.js"></script>
  <script>
    function setScreen(){
        var sUserAgent = navigator.userAgent.toLowerCase(); 
        var bIsIphoneOs = sUserAgent.match(/iphone os/i) =="iphone os"; 
        var bIsAndroid = sUserAgent.match(/android/i) =="android"; 
        if(bIsIphoneOs){
             return;
        }
        var standardDpi,dpi,w,scale;
        w = window.screen.width;
        if(w>0){
            if(w < 320){
                standardDpi = 120;
            }else if(w < 480){
                standardDpi = 160;
            }else if(w < 640){
                standardDpi = 240;
            }else if(w < 960){
                standardDpi = 320;
            }else if(w < 1280){
                standardDpi = 480;
            }else{
                standardDpi = 640;
            }
        }
        dpi = 640*standardDpi/w;
        dpi = Math.floor(dpi);
        scale = w/640;
    
        document.querySelector("meta[name=viewport]").setAttribute('content','width=640,initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0,target-densitydpi='+dpi+', user-scalable=0');
        if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/))
        {
            var msViewportStyle = document.createElement("style");
            msViewportStyle.appendChild(
                document.createTextNode("@-ms-viewport{width:auto!important}")
            );
            document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
        }
    }
    setScreen();
</script>
  <script type="text/javascript">
var Cookies = {};
/** 设置Cookies */
Cookies.set = function(name, value) {
    var argv = arguments;
    var argc = arguments.length;
    var expires = (argc > 2) ? argv[2] : null;
    var path = (argc > 3) ? argv[3] : '/';
    var domain = (argc > 4) ? argv[4] : null;
    var secure = (argc > 5) ? argv[5] : false;
    document.cookie = name + "=" + escape(value) +
       ((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
       ((path == null) ? "" : ("; path=" + path)) +
       ((domain == null) ? "" : ("; domain=" + domain)) +
       ((secure == true) ? "; secure" : "");
};

/** 读取Cookies */
Cookies.get = function(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    var j = 0;
    while (i < clen) {
        j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return Cookies.getCookieVal(j);
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0)
            break;
    }
    return null;
};

/** 清除Cookies */
Cookies.clear = function(name) {
    if (Cookies.get(name)) {
        var expdate = new Date();
        expdate.setTime(expdate.getTime() - (86400 * 1000 * 1));
        Cookies.set(name, "", expdate);
    }
};

Cookies.getCookieVal = function(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr == -1) {
        endstr = document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
};

function removeAll() {
     Cookies.set('haha', '1');
     $("#newhand").css("display","none");
     $("#picturelayer").css("display","none");
};

var colors = ["#B8D430", "#3AB745", "#029990", "#3501CB",
              "#2E2C75", "#673A7E", "#CC0071", "#F80120",
              "#F35B20", "#FB9A00", "#FFCC00", "#FEF300"];
var restaraunts = new Array();

var startAngle = 0;
var arc = Math.PI / 6;
var spinTimeout = null;

var spinArcStart = 10;
var spinTime = 0;
var spinTimeTotal = 0;
var ctx;
var tte = true;
var text;
var direction;
var wheel = document.getElementById('wheel');
var index;
var code;
var list;
var popCenterWindowTimer = null;
 function draw() {
   drawRouletteWheel();
 }
 function draw1(dushu) {
       drawRouletteWheel1(dushu);
}
 function test3() {
        setTimeout('spin(1,3)', 500);
 }
 function Xreplace(str,length)
    {
        var reg = new RegExp("(\\S{" + length + "})","g");
        return str.replace(reg,"$1<br/>");
    }
 var num=0;
 var rebool=false;
 function wheelrotate(dir,n){
      removeAll();
    if((tte==true)&&(rebool==true)){
      tte=false;
      // index=Math.floor(Math.random()*12);
      index = 10;
      var rotatetime=n*360;
      if(dir==1){
        num=2055-index*30+rotatetime;
      }else if(dir==0){
        num=-(2265+index*30+rotatetime);
      }
      var dd ="rotate("+num+"deg)";
      document.getElementById('wheelcanvas').style.webkitTransition="-webkit-transform 5s";
      document.getElementById('wheelcanvas').style.webkitTransform=dd;
      document.getElementById('wheelcanvas').style.webkitBorderRadius="200px";
      text=list[index]["cardContent"];
      var viewtext=Xreplace(text,4);
      document.getElementById('span1').innerHTML=viewtext;
      rebool==false;
      popCenterWindowTimer = setTimeout('popCenterWindow()', 5200);

      $.ajax({
        url: 'lottery.php',
        type: 'get',
        dataType: 'json',
        success: function (response) {
          // 获奖
          var rotatetime=n*360;
          if(dir==1){
            num=2055-index*30+rotatetime;
          }else if(dir==0){
            num=-(2265+index*30+rotatetime);
          }
          var dd ="rotate("+num+"deg)";
          document.getElementById('wheelcanvas').style.webkitTransition="-webkit-transform 2s";
          document.getElementById('wheelcanvas').style.webkitTransform=dd;
          document.getElementById('wheelcanvas').style.webkitBorderRadius="200px";

        index = 3;
          if(response.hit){
            if(!Cookies.get("hit")){
                index = response.index;
                code = response.code;
                Cookies.set("hit",true);
                Cookies.set("code",code);
            }
            }
          text=list[index]["cardContent"];
          var viewtext=Xreplace(text,4);
          document.getElementById('span1').innerHTML=viewtext;
          rebool==false;
          clearTimeout(popCenterWindowTimer);
          setTimeout('popCenterWindow()', 2200);
        }
      })
    }
 }
 function resetwheel(n){
         if(tte==true){
             var num=n;
             var dd ="rotate("+num+"deg)";
             document.getElementById('wheelcanvas').style.webkitTransition="";
             document.getElementById('wheelcanvas').style.webkitTransform=dd;
             rebool=true;
         }
}
function drawRouletteWheel() {

  var canvas = document.getElementById("wheelcanvas");
  
      if (canvas.getContext) {
        var outsideRadius = 300;
        var textRadius = 200;
        var insideRadius = 0;
        arc=Math.PI/6;
        
        ctx = canvas.getContext("2d");
        ctx.clearRect(0,0,538,538);
        
        
        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        var image = new Image();
        image.src = "../gameimage/zhuanpan.png";
         image.onload = function (){
            ctx.drawImage(image, 0, 0);
            ctx.stroke(); 
            ctx.fill();
           
            for(var i = 0; i < 12; i++) {
             var angle =  i * arc;
              var text1 = restaraunts[i].substr(0,5);
              for(var j=0;j<text1.length;j++){
                  ctx.save();
                  var text=text1[j];
                  ctx.translate(269 + Math.cos(angle+arc/2) * (textRadius-j*30), 269 + Math.sin(angle+arc/2) * (textRadius-j*30));
                  ctx.rotate(arc/2+angle+Math.PI/2);
                  ctx.fillStyle = "#fff";
                  ctx.font="bold 30px 微软雅黑";
                  ctx.strokeStyle="#000";
                  ctx.strokeText(text,-14.5,-14.5);
                  ctx.fillText(text,-14.5,-14.5);
                  ctx.restore();
                  
              }
         
          }
          }
  } 
}  
 var SHAKE_THRESHOLD = 3000;  
 var last_update = 0;  
 var x = y = z = last_x = last_y = last_z = 0;  
 function deviceMotionHandler(eventData) {
        if(tte){
        var acceleration = eventData.accelerationIncludingGravity;  
        var curTime = new Date().getTime();  
        if ((curTime - last_update) > 100) {  
            var diffTime = curTime - last_update;  
            last_update = curTime;  
            x = acceleration.x;  
            y = acceleration.y;  
            z = acceleration.z;  
            var speed = (Math.abs(x - last_x ) + Math.abs(y - last_y) + Math.abs(z - last_z)) / diffTime * 10000;  
            if (speed > SHAKE_THRESHOLD) { 
                if(speed > 3000 && speed < 3800){
                    resetwheel(0);
                    setTimeout('wheelrotate(1,0)',20);

                 }
                if(speed >= 3800 && speed < 4500){
                    resetwheel(0);
                    setTimeout('wheelrotate(1,1)',20);

                 }
                if(speed >= 4500 && speed < 5300){
                    resetwheel(0);
                    setTimeout('wheelrotate(1,2)',20);
     
                 }
                if(speed >= 5300){
                    resetwheel(0);
                    setTimeout('wheelrotate(1,3)',20);

                 }
            }  
            last_x = x;  
            last_y = y;  
            last_z = z;  
        }  
        }
    }    
$(function(){
      list = [
          {
              "cardContent": "家庭旅游大奖"
          },
          {
              "cardContent": "亲情电话卡50元"
          },
          {
              "cardContent": "亲情水杯"
          },
          {
              "cardContent": "再来一次"
          },
          {
              "cardContent": "温情靠枕"
          },
          {
              "cardContent": "亲情电话卡50元"
          },
          {
              "cardContent": "亲情水杯"
          },
          {
              "cardContent": "温情靠枕"
          },
          {
              "cardContent": "亲情电话卡50元"
          },
          {
              "cardContent": "温情靠枕"
          },
          {
              "cardContent": "再来一次"
          },
          {
              "cardContent": "亲情水杯"
          }
      ];
       for (var i = 0; i < list.length; i++) {
             var cardContent = list[i]["cardContent"]; 
             restaraunts[i] = cardContent;
       }
       draw();
      if (window.DeviceMotionEvent) {  
          window.addEventListener('devicemotion', deviceMotionHandler, false);  
      }
      $("#wheelcanvas").bind("click", function(){
          resetwheel(0);
          setTimeout('wheelrotate(1,1)',20);
      });
});

var windowHeight; 
var windowWidth; 
var popWidth; 
var popHeight; 
function init(){ 
   windowHeight=$(window).height(); 
   windowWidth=$(window).width(); 
} 

function closeWindow(){ 
   $("#yesBtn").click(function(){ 
       tte=true;
      $("#newhand").css("display","none");
       var ctlwin=document.getElementById('ctlwin').style;
       ctlwin.display="none";
       ctlwin.width="0px";
       ctlwin.height="0px";
       $("#center").removeClass("xuanzhuan").css("height","0px").css("width","0px").css("top","500px").css("margin-left","320px");
        setTimeout('rre()',1000);
        }); 

    } 
    function rre(){
        document.getElementById('ctlwin').style.display="block";
    }
function popCenterWindow(){ 
    init(); 
    var chooseWitch = 0;
    if(list[index]["cardContent"] != "再来一次"){
        chooseWitch=1;
    }
    switch(chooseWitch)
    {  
        case 1:
            $("#back1").css("background","url(../gameimage/background_02.png)");
            $("#code").text(code);
            $('#lottery-tips').show();
            break;
        case 0:
            $("#back1").css("background","url(../gameimage/smile.png)");
            document.getElementById('span1').innerHTML="";
            $('#lottery-tips').hide();
            break;
    }
    var popY=(windowHeight-popHeight)/2; 
    var popX=(windowWidth-popWidth)/2; 

    $("#newhand").css("display","block");
    $("#newhand").css("background-color","#000");
    var ctlwin=document.getElementById('ctlwin').style;
    ctlwin.width="640px";
    ctlwin.height="1000px";
    $("#center").addClass("xuanzhuan").css("top","200px").css("margin-left","126px").css("height","600px").css("width","494px");
    closeWindow(); 

} 
    
var num_ct = 0;
function down()
{
    ++num_ct;
    if(num_ct<10)
    show();
    var width = window.screen.width;
    var heigth = window.screen.height;
    var nheigth = 1000*width/640;
    var maxscroll = nheigth - heigth;
    if(maxscroll&&document.body.scrollTop<maxscroll)
        {
         $("#downBord").css("display","block");
        }
    else
        $("#downBord").css("display","none");
}
sh=setInterval('down()',300);
function show(){

     var imgid=document.getElementById("downBord");

     if(imgid.style.visibility == "visible")

        imgid.style.visibility = "hidden";

     else

        imgid.style.visibility = "visible";

      }
</script></head>
<body>
  <div id="newhand" onClick="removeAll()"></div>
  <div id = "picturelayer" onClick="removeAll()">
    <input id = "picture" type="image" src="../gameimage/new_hand.png" width="500px" height="600px" ></div>
  <div>
    <div style="position:absolute; top:200px;margin-left:60px; width:538px; height:538px;overflow:hidden;z-index:102;" id="wheel">
      <canvas id="wheelcanvas" width="538px" height="538px" style="cursor: pointer;-webkit-border-radius: 100px;-moz-border-radius: 100px;" ></canvas>
    </div>
    <img src="../gameimage/pic_zhuanpan_02.png"  style="margin:365px 275px; position:absolute; z-index:103;"/>
  </div>
  <div id="ctlwin" style="top:0px;width:0px; height:0px; overflow:hidden; position:absolute;z-index:3000;">
    <div class="window" id="center" style = "position:absolute;margin-left:320px;top:500px;width:0px;height:0px;-webkit-transition-duration: 0.5s;-moz-transition-duration: 0.5s;-o-transition-duration:0.5s;overflow:hidden">
      <div id = "back1" style="width:398px;height:594px;"></div>
      <div id="title" class="title"></div>
      <div class="content1">
        <div style="margin:100px auto;">
          <span id="span1" style="font-size:36px;color:#FFF; font-family:微软雅黑;text-align:center;position:absolute;z-index:100;top:150px;left:100px;width:200px"></span>
          <p id="lottery-tips" style="font-size:20px;color:#FFF; font-family:微软雅黑;text-align:center;position:absolute;z-index:100;top:250px;left:50px;width:300px">
            您的兑换码为：
            <span id="code" style="font-size:25px;">******</span>
            <br />
            关注神马官方微信：smcn428
            <br />
            发送兑换码、姓名、电话、地址
            <br />
			领取您的奖品吧！
          </p>
        </div>
      </div>
      <div style="position:absolute;z-index:101;margin:-250px 105px;">
        <input type="image" id="yesBtn" src="../gameimage/button_ok01.png" style="width:190px; height:95px;"/>
      </div>

    </div>

  </div>
  <!-- 图片预加载 -->
  <div style="position:absolute; margin:auto auto; width:0px; height:0px; overflow:hidden">
    <img src="../gameimage/background_02.png" />
    <img src="../gameimage/smile.png" />
  </div>
</body>
  <script type="text/javascript">
var screenHeigth = window.screen.height;
var screenWidth = window.screen.width;

var centerPointX = 339;
var centerPointY = 519;


function initAngle(x,y)
{
    
    
    if(y<=centerPointY&&x>=centerPointX)
    {
         var angle = 180 * Math.atan((x-centerPointX)/(centerPointY-y)) / Math.PI;
         return angle;
    }
    if(y>centerPointY&&x>centerPointX)
    {
         var angle = 180 * Math.atan((y-centerPointY)/(x-centerPointX)) / Math.PI + 90;
         return angle;
    }
    if(y>=centerPointY&&x<=centerPointX)
    {
         var angle = 180 * Math.atan((centerPointX-x)/(y-centerPointY)) / Math.PI + 180;
         return angle;
    }
    if(y<centerPointY&&x<centerPointX)
    {
         var angle = 180 * Math.atan((centerPointY-y)/(centerPointX-x)) / Math.PI + 270;
         return angle;
    }
}
var tempAngle=0;
var tempAngle1 = 0;
var startX = 0;
var startY = 0;
var endX = 0;
var endY = 0;
var totalLength = 0;
var count = 0;
var startTime = 0;
var endTime = 0;
var isEnd = true;
var noMoveTime = 0;
var noMoveTimeEnd = 0;
var theStartLeft = 60;

var isTheLast = 0;
var sumLength = 0;
var countNum = 0;
function load (){
 
    document.getElementById("wheelcanvas").addEventListener('touchstart',touch, false);
    document.getElementById("wheelcanvas").addEventListener('touchmove',touch, false);
    document.getElementById("wheelcanvas").addEventListener('touchend',touch,false);
    function touch (event){
        var event = event || window.event;
       
    
      switch (event.type) {
            case "touchstart":
                isTheLast = 0;
                startTime = new Date().getTime();
                totalLength = 0;
                tempAngle = initAngle(event.touches[0].pageX,
                        event.touches[0].pageY);
                startX = event.touches[0].screenX;
                startY = event.touches[0].screenY;
                break;
            case "touchend":
                endTime = new Date().getTime();
                var power = totalLength * 20 / (endTime - startTime);
                var num = 1;
                if(totalLength<100)
                    break;
                if(isTheLast == 1&&endTime - noMoveTime>10)
                    break;

                if (0 <= tempAngle - tempAngle1)
                    num = 1;
                if ((0 <= power && power <= 3)&&tte==true)
                    resetwheel(0);
                    setTimeout('wheelrotate('+num+',1)',20);
                if ((3 < power && power<= 6)&&tte==true)
                    resetwheel(0);
                    setTimeout('wheelrotate('+num+',1)',20);
                if ((6 < power && power<= 10)&&tte==true)
                    resetwheel(0);
                    setTimeout('wheelrotate('+num+',2)',20);
                if ((10 < power)&&tte==true)
                    resetwheel(0);
                    setTimeout('wheelrotate('+num+',3)',20);
                break;
            case "touchmove":
                var firstTouch = initAngle(event.touches[0].pageX,event.touches[0].pageY);
                
                endX = event.touches[0].screenX;
                endY = event.touches[0].screenY;
                var length = Math.sqrt(Math.pow(Math.abs(startX - endX),2)+ Math.pow(Math.abs(startY - endY),2));
                
                sumLength = sumLength + Math.abs(firstTouch - tempAngle);
                ++countNum;
                if(countNum>=10)
                    {
                    noMoveTime = new Date().getTime();
                    
                    isTheLast = 1;
                    countNum = 0;
                    sumLength = 0;
                    }
                if(sumLength>10)
                    {
                    isTheLast = 0;
                    countNum = 0;
                    sumLength = 0;                  }               
                totalLength = totalLength + length;
                if(tte){
                    resetwheel(firstTouch);
                }
                tempAngle1 = tempAngle;
                tempAngle = firstTouch;
                startX = endX;
                startY = endY;
                event.preventDefault();
                
                break;
            }

        }
    }
    window.addEventListener("load", load, false);
    if (Cookies.get('haha'))
        removeAll();

</script>
  <script>
var dataForWeixin={
    appId:  "",
    img:    "http://examples.jd-app.com/pingwei/gameimage/logo.png",
    url:    "http://examples.jd-app.com/pingwei/",
    title:  "摇摇乐",
    desc:   "摇一摇，神马感恩回馈",
    fakeid: ""
};
(function(){
    var onBridgeReady=function(){
        // 发送给好友; 
        WeixinJSBridge.on('menu:share:appmessage', function(argv){
            WeixinJSBridge.invoke('sendAppMessage',{
                "appid":        dataForWeixin.appId,
                "img_url":      dataForWeixin.img,
                "img_width":    "120",
                "img_height":   "120",
                "link":             dataForWeixin.url,
                "desc":             dataForWeixin.desc,
                "title":            dataForWeixin.title
            }, function(res){});
        });
        // 分享到朋友圈;
        WeixinJSBridge.on('menu:share:timeline', function(argv){
            WeixinJSBridge.invoke('shareTimeline',{
            "img_url":dataForWeixin.img,
            "img_width":"120",
            "img_height":"120",
            "link":dataForWeixin.url,
            "desc":dataForWeixin.desc,
            "title":dataForWeixin.title
            }, function(res){});
        });
        // 分享到微博;
        WeixinJSBridge.on('menu:share:weibo', function(argv){
            WeixinJSBridge.invoke('shareWeibo',{
            "content":dataForWeixin.title+' '+dataForWeixin.url,
            "url":dataForWeixin.url
            }, function(res){});
        });
    };
    if(document.addEventListener){
        document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
    }else if(document.attachEvent){
        document.attachEvent('WeixinJSBridgeReady'   , onBridgeReady);
        document.attachEvent('onWeixinJSBridgeReady' , onBridgeReady);
    }
})();
</script>
<script src="//track.timepearls.com/js_tracker.min.js"></script>
</html>
