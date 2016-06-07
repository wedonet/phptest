<?php

require_once(__DIR__ . '/../global.php');


$sql = 'select id,title from `'.sh.'_place` where comid=144 ';
$result = $pdo->fetchAll($sql);

print_r($result);