<?php

/* 从阿里云获取域名列表 */

ob_start();
header('Content-Type:text/html; charset=UTF-8');
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

date_default_timezone_set("UTC");




$a['Action'] = 'DescribeDomainRecords';
$a['DomainName'] = 'ejshendeng.com';


$url = aliyurl($a);

echo($url);


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //如果把这行注释掉的话，就会直接输出  
$result = curl_exec($ch);
curl_close($ch);

print_r(json_decode($result, true));



/* 生成访问阿里云的URL
 * 以数组形式传入参数
 * 例如： 
 * $a['Action'] = 'DescribeDomainRecords';
 * $a['DomainName'] = 'ejshendeng.com';
 * AccessKeyId，
 *  */

function aliyurl($a) {

    $b = $a;

    $b['AccessKeyId'] = '1VeNBNaqVPp7lzFs';
    $b['Format'] = 'JSON';
    $b['SignatureMethod'] = 'HMAC-SHA1';
    $b['SignatureNonce'] = time();
    $b['SignatureVersion'] = '1.0';

    //$b['Timestamp'] = '2016-03-24T16:41:54Z';
    $b['Timestamp'] = date('Y-m-d', time()) . 'T' . date('H:i:s', time()) . 'Z';

    $b['Version'] = '2015-01-09';


    ksort($b);

    $s = 'GET';
    $s .= '&';
    $s .= rawurlencode('/');
    $s .= '&';

    $c = array();

    foreach ($b as $k => $v) {
        if ('Timestamp' == $k) {
            $v = rawurlencode($v);
        }
        $c[] = ($k . '=' . $v);
    }

    $str = join('&', $c);

    $StringToSign = $s . rawurlencode($str);

    /*Rw3OQGVOVl7w8NS5vdUErRCcTnIIoi是在阿里云上的Access Key Secret*/
    $Signature = base64_encode(hash_hmac("sha1", $StringToSign, 'Rw3OQGVOVl7w8NS5vdUErRCcTnIIoi&', true));



    $url = 'http://alidns.aliyuncs.com/?';
    $url .= $str;
    $url .= '&Signature=' . $Signature;

    return $url;
}
