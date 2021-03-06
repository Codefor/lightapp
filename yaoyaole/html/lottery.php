<?php
/**
1、家庭旅游大奖 x 1
2、亲情电话卡50元  x 100
3、亲情水杯 x 100
4、温情靠枕 x 100
*/
$data = array('E30CB0','7E8BD2','F8AC06','A44A99','1C569B','DB5A08','D4174D','74D8B4','A3FA83','747DF9','EDF189','1050A6','762E0F','B2EFBC','D3E715','5B5ED1','AC4B9C','28B9C9','A85660','F26897','EB4D57','513753','060885','6660DC','9BA941','6B5B7B','AF91F4','F29D7E','BF23DD','A958F2','E89109','4FC218','B5A38B','448154','B3557C','CCBE2C','192523','DBC9DD','2D1C4D','8BEAD7','F87097','4B90E6','A765F4','3F506F','940726','E580F2','CB4E4D','1ECE91','A5AAF1','F6A06C','52DCDE','BBEFA6','6A12AD','51AB0C','63003E','581098','F734B1','AB3D95','D0833F','7C9B40','91C45D','549E45','E4D645','546A16','BEA6A4','F4DCE8','C4CE0B','2282C1','23770D','123C2F','A815E2','BE29F6','05C4D6','68AC01','BA41A8','0B21B5','2D55D2','82565C','64759B','61CEE8','FAD80B','C69C21','67488C','03E862','7009ED','3AD832','7C01E8','AD9853','EEF98F','DD2F2F','FFCA1B','6FBAEF','99BA66','09F360','D7027D','B9B73F','32DDCE','4D5092','62650F','5BFA80','05B419','6F1E39','9C5C4A','59D99A','FB6138','E80494','FF0334','165BB1','E68589','5FBEF4','A68F7C','F613E7','6C9B83','4DB590','C6B2E8','AF0C49','CD4F1F','8F83C3','0D4710','F9D797','CCE972','E1B40B','89BB44','E2510A','C977CA','59C5E9','D15DF6','D44CD3','280AD8','541F6F','9791BE','FE9AAB','7F3D17','70F3A5','681C95','15AD97','39D5B9','70352E','945D24','8EF4AA','557DB7','EF3067','C4E1E2','350735','CA6F8B','CC4758','609D28','DB4708','823FF6','851393','C81D0D','F34B85','4DC4EA','70B1B6','644953','5D4175','7E3170','1FE721','0054BF','FA209B','5DAC31','1FA5C8','AF0246','26481C','7D4960','0E4A78','AF511A','EC6EBD','47DC6B','50E1F3','A7F1C6','912AE1','CD5E16','302459','64A28D','A5BD23','D23CDA','46E5B8','9300AF','CC5A5E','91342D','2C0BC0','BBAE2B','55E0D7','E9507A','EEDAC7','208ACE','07D957','C5A745','CFF90F','CB8837','5919A1','DCC4EE','A0883F','28ADA5','D3FBE0','B848EC','3AF4C6','BFF341','40350A','1220DD','415A16','06BC74','7C3C41','1E3DD4','ADF08D','CDAFEE','6D05B0','6F0EAD','0EDC37','D57AE7','9EADED','9572EA','B917A4','BDDF6A','252B4A','B7F56D','9ECA37','3A09F8','4CA5F9','31502D','560D09','9F2DE6','D0DB6C','9826C1','1538C3','7AA742','6B0A87','C717A4','9BDEDE','1B9B68','2A7CF7','0D1E64','277F4E','8D71FD','1D014A','B6D555','226175','E85203','B6BD6F','4A35ED','732019','F36AC4','073379','AE623F','E78F58','489DB5','D7791E','CCC005','48A635','94FD7E','FCEA41','BAF51C','6971AC','12E757','F8876A','E2FED0','6EB5B4','7D51F5','F23EF5','46C625','9DCDCD','4923F8','EF69CC','C7C0A1','87F87E','E6B865','6533FB','9D67FE','17D79E','203572','C3530B','8A146A','64F589','8CD727','BF13EC','0D712F','B4EEEE','4920A4','D0DAFB','87FF72','E9D929','0242E3','D82B9D','582B20','552A24','A930D4','FF49A8','551BE9','A9F359','929475','ECBF54','3FD4E0','5B8B19','ADC29E','1BD5F0','526A59','8EDCE0','36DC2F','10D232','A194CB');

if(rand() <= 0.001){
    //first hit
    $idx = array_rand($data);

    $redis = new Redis();
    $redis->pconnect('127.0.0.1');
    $already_hit = $redis->hGet("yaoyaole",$data[$idx]);
    if(!$already_hit){
        $json = array('hit'=>TRUE,'title'=>'','code'=>$data[$idx]);
        $redis->hSet("yaoyaole",$data[$idx],$_COOKIE['permanent_id']);

        if($idx <= 0){
            $json['title'] = '旅游大奖';
            $json['index'] = 0;
        }else if($idx <= 100){
            $json['title'] = '亲情电话卡50元';
            $json['index'] = 1;
        }else if($idx <= 200){
            $json['title'] = '亲情水杯';
            $json['index'] = 2;
        }else{
            $json['title'] = '温情靠枕';
            $json['index'] = 4;
        }

        echo json_encode($json);
        die();
    }
}

$json = array('hit'=>FALSE,'again'=>(mt_rand(1,10) < 1));
echo json_encode($json);
