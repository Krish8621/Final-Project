<?php
if ( !isset($_COOKIE['username']) ) {
	header('location:login');
}

//Database Connection
require 'admin/connection.php';

//generate fake link
$fake_link = sha1(rand(1000,9999));

//Functions
include 'function.php';

?>