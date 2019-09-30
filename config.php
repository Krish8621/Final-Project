<?php

$now = date('Y-m-d H:i:s',time());

//Check User Service Type
if ( !isset($_COOKIE['service_type']) ) {
	header('location:start');
}

//Check User Service Type
if ( isset($_GET['change_service_type']) && $_GET['change_service_type'] == 'true' ) {

    setcookie("service_type", '', time() - 36000); 
	header('location:start');
}


//Database Connection
require 'admin/connection.php';

//generate fake link
$fake_link = sha1(rand(1000,9999));

//Functions
//include 'function.php';

?>