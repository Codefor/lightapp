<?php
$data = file_get_contents("php://input");
file_put_contents("log.txt",sprintf("%s,%s,%s\n",date('Y-m-d H:i:s'),$_SERVER['REMOTE_ADDR'],urldecode($data)));
