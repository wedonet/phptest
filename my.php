<?php


ob_start();
header('Content-Type:text/html; charset=UTF-8');
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Shanghai');
ini_set('date.timezone', 'Asia/Shanghai');


session_start();


require('pdo.php');



$pdo = new Cls_Pdo();

$uname = $_GET['uname'];


$a['uname'] = $uname;
$a['content'] = 'bdddd';

$count = $pdo->insert('user', $a);





$db = null;
?>




 