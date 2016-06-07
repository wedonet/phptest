<?php
date_default_timezone_set("UTC"); 
$ch = curl_init();

$url = 'http://alidns.aliyuncs.com/';

$url .= '?Format=json';

$url .= '&Version=2015-01-09';

$url .= '&AccessKeyId=1VeNBNaqVPp7lzFs';

$url .= '&Signature=Pc5WB8gokVn0xfeu%2FZV%2BiNM1dgI%3D'; 

//$url .= '&SignatureMethod=HMAC-SHA1';
Rw3OQGVOVl7w8NS5vdUErRCcTnIIoi

$url .= '&Timestamp='.date('Y-m-d',time()).'T'.date('H:i:s',time()).'Z';

$url .= '&SignatureVersion=1.0';

$url .= '&SignatureNonce='.time();
    
echo $url;
echo '<br />';
echo '<br />';

//curl_setopt($ch, CURLOPT_URL, "http://www.ejshendeng.com/bying/index.php");

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
$result = curl_exec($ch);
curl_close($ch);

echo $result;


