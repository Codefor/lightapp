<?php
if(isset($_POST['name']) && isset($_POST['content'])){
    $name = trim($_POST['name']);
    $content = trim($_POST['content']);

    $key = "daoyan_comment";
    $redis = new Redis();
    $redis->pconnect('127.0.0.1');
    $id = uniqid();
    $redis->lPush($key,json_encode(array('id'=>$id,'name'=>$name,'content'=>$content,'t'=>$_SERVER['REQUEST_TIME'])));

    $redis->close();
}
header('Content-Type:application/json');
echo json_encode(array('status'=>0,'id'=>$id));
