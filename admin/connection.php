<?php
error_reporting(0);
date_default_timezone_set('Asia/Colombo');
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'pc_part_new';

$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
mysqli_query("set character_set_server='utf8'");
mysqli_query("set names 'utf8'");
?>