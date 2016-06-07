<?php

require_once(__DIR__ . '/../../global.php');

$m = new MongoClient('127.0.0.1:27017');


// 选择一个数据库
$db = $m->testclient;


$collection = $db->mac;

$user = array('name' => 'caleng', 'email' => 'admin@admin.com');              // 新增 

set_time_limit(6000); 

for ($i = 0; $i < 100000; $i++) {
    $user['_id'] = nextid($db, 'mac');
    $user['name'] = 'sun';
    $user['uid'] = $i;
    $collection->insert($user);
}

function nextid($db, $sequenceName) {
    $sequenceDocument = $db->counters->findAndModify(
            array('_id' => $sequenceName), array('$inc' => array('id' => 1)), array(), array('new' => true)
    );


    return $sequenceDocument['id'];
}

$m->close();

