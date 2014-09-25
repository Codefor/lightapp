<?php
if(isset($_POST['id']) && (int)$_POST['id'] > 0){
    $id = (int)$_POST['id'];
    $hkey = "daoyan_vote";
    $hfield = "ending_" . $id;

    $redis = new Redis();
    $redis->pconnect('127.0.0.1');
    $redis->hIncrBy($hkey,$hfield,1);

    $redis->close();
}
header('Content-Type:application/json');
echo json_encode(array('status'=>0));
