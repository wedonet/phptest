<?php

require_once('aliyunurl.php');


$c_url = new aliyunurl();


if (isset($_GET['act'])) {
    $act = $_GET['act'];
} else {
    $act = '';
}


switch ($act) {
    case '':
        htmlmain();
        break;
    case 'set':
        SetRecordStatus();
        break;
}

function htmlmain() {
    $c_url = & $GLOBALS['c_url'];

    $a['Action'] = 'DescribeDomainRecords';
    $a['DomainName'] = 'www.ejshendeng.com';

    $url = $c_url->makeurl($a);

    $result = $c_url->getcongent($url);

    print_r($result);
}

function SetRecordStatus() {
    $c_url = & $GLOBALS['c_url'];

    $a['Action'] = 'SetDomainRecordStatus';
    $a['RecordId'] = '75868105';
    $a['Status'] = 'Enable';
    
    $url = $c_url->makeurl($a);

    $result = $c_url->getcongent($url);

    print_r($result);
}
