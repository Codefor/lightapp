
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <meta content="email=no" name="format-detection">
    <title>神马搜索感恩节特别行动</title>
    <style>
        *{padding:0;font:12px/1.3em "Microsoft YaHei","Microsoft JhengHei",Arial,Helvetica,sans-serif;margin-left:0;margin-right:0;margin-top:0;outline:0;-webkit-tap-highlight-color:rgba(0,0,0,0);word-break:keep-all;white-space:nowrap;box-sizing:border-box;-webkit-box-sizing:border-box;}
        body,html {width: 100%;height: 100%;min-width: 320px;}
        .home{width:100%;height:100%;padding-top:104%;background: url(gameimage/home-bg.jpg) #f5f0ea no-repeat center top;background-size: 100% auto;}
        .home-btn {display:block;width: 47%;padding-bottom: 14%;margin-left:26.5%;background: url(gameimage/home-btn.png) no-repeat; background-size: 100% auto;}
    </style>
    <script type="text/javascript" src="js/zepto.1.1.4.min.js"></script>
</head>
<body>
    <section class="home">
        <a href="http://m.sm.cn/s?q=%E6%84%9F%E6%81%A9%E8%8A%82&from=sm&by=submit&snum=6" class="home-btn"></a>
    </section>
<script>
var dataForWeixin={
    appId:  "",
    img:    "http://demo.timepearls.com/yaoyaole/gameimage/yaoyaole-logo.jpg",
    url:    "http://demo.timepearls.com/yaoyaole/",
    title:  "神马搜索感恩节特别行动",
    desc:  "这个感恩节，想给你心存感激的人们一点惊喜和感动？ 神马搜索为您准备了旅游大奖、50元电话卡等海量感恩礼物！ ……>>>",
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
</body>
</html>
