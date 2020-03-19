<?php
// coded by bolesni

function myErrorHandler($errno,$errstr,$errfile,$errline){
    // throw new Exception("$errno,$errstr", 1);
  }
  set_error_handler('myErrorHandler');

$ips =  explode("\n",file_get_contents('tocheck.txt'));
$port = '80';
$live = 'live.txt';

foreach ((array) $ips as $ip){
    try{
    $check = fsockopen($ip, $port, $error, $error_info, 2);
    if($check)
    {
        echo '[HOST]:'.$ip.' is is up'."\n";
        $fp = fopen($live, 'a');//opens file in append mode  
        fwrite($fp, $ip."\n");
        fclose($fp);  
    }
    else
    {
        throw new Exception('[HOST]:'.$ip.' - is down'."\n");
    }
}catch(Exception $e){
    echo $e;
  }
}
?>
