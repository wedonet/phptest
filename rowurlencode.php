<?php
ob_start();
header('Content-Type:text/html; charset=UTF-8');
//error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);
echo rawurldecode(':');