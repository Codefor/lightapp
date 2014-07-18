<?php
$id = (int)($_POST["id"]);
file_put_contents(
    "log.txt",
    sprintf("%s\t%s\t%s\n",$id,$_SERVER['REMOTE_ADDR'],date('Y-m-d H:i:s')),
    FILE_APPEND);
$items = explode("\n",trim(file_get_contents("log.txt")));
$total = array();
foreach($items as $item){
    list($id,$ip,$t) = explode("\t",$item);
    if(!isset($total[(int)$id])){
        $total[(int)$id] = 0;
    }
    $total[(int)$id] ++;
}
arsort($total);
$f = fopen('result.txt','w');
foreach($total as $k=>$v){
    fwrite($f,"$k,$v\n");
}
fclose($f);
