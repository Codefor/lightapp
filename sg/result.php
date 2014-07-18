<?php
$config = json_decode('[{"name":"刘玲","id":"0","img":"img/Tirling.jpg"},{"name":"沈雪丽","id":"1","img":"img/Sherr-yy.jpg"},{"name":"季萍","id":"2","img":"img/xpz__mao.jpg"},{"name":"孙欣磊","d":"3","img":"img/Somnus_0123.jpg"},{"name":"滕雨菲","id":"4","img":"img/xinruo92.jpg"},{"name":"万茜","id":"5","img":"img/sissi37.jpg"},{"name":"吴靓文","id":"6","img":"img/xlyf_wenwen0718.jpg"},{"name":"尹依茜","id":"7","img":"img/Eva.jpg"},{"name":"余燕平","id":"8","img":"img/yuyu98063.jpg"},{"name":"虞伷","id":"9","img":"img/Sinkyran.jpg"},{"name":"赵莉莎","id":"10","img":"img/wmxnr.jpg"},{"name":"陆嘉怡","id":"11","img":"img/Lujiayi1.jpg"},{"name":"周璇","id":"12","img":"img/cathrin_qiqi.jpg"},{"name":"郁林欢","id":"13","img":"img/promise_yuu.jpg"},{"name":"罗瑞","id":"14","img":"img/wcn19921107.jpg"},{"name":"刘迪","id":"15","img":"img/H_909545397.jpg"},{"name":"郝子晗","id":"16","img":"img/zoey.jpg"},{"name":"孙盈婷","id":"17","img":"img/yinyy.jpg"},{"name":"蔡霁雯","id":"18","img":"img/cjw_Bao.jpg"},{"name":"李栗颖","id":"19","img":"img/leeleeleezoe.jpg"}]',TRUE);
$items = explode("\n",trim(file_get_contents("result.txt")));

header("Content-Type:appliaction/json");

/**
$s = "var ranking_list = [";
foreach($items as $item){
    list($id,$c) = explode(",",$item);
    $id = (int)$id;
    $s .= sprintf('{
        vote: "%s",
        name: "%s",
        img: "%s"
    },',(int)$id,$config[$id]['name'],$config[$id]['img']);
}
echo rtrim($s,',').']';
*/
$res = array();
foreach($items as $item){
    list($id,$c) = explode(",",$item);
    $id = (int)$id;
    $res[] = array(
        "vote"=>$c,
        "name"=>$config[$id]['name'],
        "img"=>$config[$id]['img']
    );
}
echo json_encode($res);

