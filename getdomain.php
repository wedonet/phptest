<?php

/*从阿里云获取域名列表*/

ob_start();
header('Content-Type:text/html; charset=UTF-8');
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

/*url*/
//http://alidns.aliyuncs.com/?Format=XML&AccessKeyId=testid&Action=DescribeDomainRecords&SignatureMethod=HMAC-SHA1&DomainName=example.com&SignatureNonce=f59ed6a9-83fc-473b-9cc6-99c95df3856e&SignatureVersion=1.0&Version=2015-01-09&Timestamp=2016-03-24T16:41:54Z
    
 
/*排序后*/    
//http://alidns.aliyuncs.com/?AccessKeyId=testid&Action=DescribeDomainRecords&Format=XML&SignatureMethod=HMAC-SHA1&DomainName=example.com&SignatureNonce=f59ed6a9-83fc-473b-9cc6-99c95df3856e&SignatureVersion=1.0&Version=2015-01-09&Timestamp=2016-03-24T16:41:54Z
    
$s = 'GET';
$s .= '&';
$s .= rawurlencode('/');
$s .= '&';

$t = '';
$t .= 'AccessKeyId=testid';
$t .= '&Action=DescribeDomainRecords';
$t .= '&DomainName=example.com';
$t .= '&Format=XML';
$t .= '&SignatureMethod=HMAC-SHA1';
$t .= '&SignatureNonce=f59ed6a9-83fc-473b-9cc6-99c95df3856e';
$t .= '&SignatureVersion=1.0';

$t .= '&Timestamp='. rawurlencode('2016-03-24T16:41:54Z');


$t .= '&Version=2015-01-09';


die(rawurlencode(':'));

$s .= rawurlencode($t);


    
echo $s;

echo '<br />';
echo '<br />';

$a = 'GET&%2F&AccessKeyId%3Dtestid%26Action%3DDescribeDomainRecords%26DomainName%3Dexample.com%26Format%3DXML%26SignatureMethod%3DHMAC-SHA1%26SignatureNonce%3Df59ed6a9-83fc-473b-9cc6-99c95df3856e%26SignatureVersion%3D1.0%26Timestamp%3D2016-03-24T16%253A41%253A54Z%26Version%3D2015-01-09';

echo $a;die;

$b = base64_encode(hash_hmac("sha1", $a, 'testsecret&', true));

//$b = hash_hmac('sha1', $a, 'testsecret&');

echo 'hash_hmac:'.$b;


echo '<br />';

echo 'urlencode后'.  rawurlencode($b);



