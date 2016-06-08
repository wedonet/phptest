<?php
require_once('aliyunurl.php');


$a['Action'] = 'DescribeDomainRecords';
$a['DomainName'] = 'test.ejshendeng.com';
$a['PageNumber'] = 1;
$a['PageSize'] = 10;


/* 
 * 修改阿里云解析记录
 */

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

