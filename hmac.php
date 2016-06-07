<?php
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
$s .= urlencode('/');
$s .= '&';




$CanonicalizedQueryString = 'AccessKeyId=testid&Action=DescribeDomainRecords&Format=XML&SignatureMethod=HMAC-SHA1&DomainName=example.com&SignatureNonce=f59ed6a9-83fc-473b-9cc6-99c95df3856e&SignatureVersion=1.0&Version=2015-01-09&Timestamp=2016-03-24T16:41:54Z';


$s .= urlencode($CanonicalizedQueryString);


    
echo $s;

echo '<br />';
echo '<br />';

$a = 'GET&%2F&AccessKeyId%3Dtestid%26Action%3DDescribeDomainRecords%26DomainName%3Dexample.com%26Format%3DXML%26SignatureMethod%3DHMAC-SHA1%26SignatureNonce%3Df59ed6a9-83fc-473b-9cc6-99c95df3856e%26SignatureVersion%3D1.0%26Timestamp%3D2016-03-24T16%253A41%253A54Z%26Version%3D2015-01-09';

echo $a;die;

$b = base64_encode(hash_hmac("sha1", $a, 'testsecret&', true));

//$b = hash_hmac('sha1', $a, 'testsecret&');

echo 'hash_hmac:'.$b;


echo '<br />';

echo 'urlencode后'.  urlencode($b);







//
//
//
//
//
//
//
//
////$b = hash_hmac('md5', 'sha1', $a);
//
//echo $b;
//
//die;
//echo 'sha1='.$b;
//
//echo '<br />';
//
//$c = base64_encode($b);
//
//echo 'base64='.$c;
//
//echo '<br />';
//
//$d = urlencode($c);
//
//echo 'sha1 & base 64 & urlencode='.$d;
//
//echo '<br />';
//
//echo getSignature('GET&%2F&AccessKeyId%3Dtestid%26Action%3DDescribeDomainRecords%26DomainName%3Dexample.com%26Format%3DXML%26SignatureMethod%3DHMAC-SHA1%26SignatureNonce%3Df59ed6a9-83fc-473b-9cc6-99c95df3856e%26SignatureVersion%3D1.0%26Timestamp%3D2016-03-24T16%253A41%253A54Z%26Version%3D2015-01-09', 'testsecret');
//
//echo '<br />';
//
//echo urlencode(base64_encode( getSignature('GET&%2F&AccessKeyId%3Dtestid%26Action%3DDescribeDomainRecords%26DomainName%3Dexample.com%26Format%3DXML%26SignatureMethod%3DHMAC-SHA1%26SignatureNonce%3Df59ed6a9-83fc-473b-9cc6-99c95df3856e%26SignatureVersion%3D1.0%26Timestamp%3D2016-03-24T16%253A41%253A54Z%26Version%3D2015-01-09', 'testsecret')));
//
// function getSignature($str, $key) {
//        $signature = "";
//        if (function_exists('hash_hmac')) {
//            $signature = base64_encode(hash_hmac("sha1", $str, $key, true));
//        } else {
//            $blocksize = 64;
//            $hashfunc = 'sha1';
//            if (strlen($key) > $blocksize) {
//                $key = pack('H*', $hashfunc($key));
//            }
//            $key = str_pad($key, $blocksize, chr(0x00));
//            $ipad = str_repeat(chr(0x36), $blocksize);
//            $opad = str_repeat(chr(0x5c), $blocksize);
//            $hmac = pack(
//                    'H*', $hashfunc(
//                            ($key ^ $opad) . pack(
//                                    'H*', $hashfunc(
//                                            ($key ^ $ipad) . $str
//                                    )
//                            )
//                    )
//            );
//            $signature = base64_encode($hmac);
//        }
//        return $signature;
//    }