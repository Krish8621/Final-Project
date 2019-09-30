<?php
define(DB_CONNECTION, "admin/connection.php" );



function province_select($id){

	//Database Connection
	require DB_CONNECTION;

	$query = $db->query("SELECT * FROM `location` WHERE `id` = '$id' ");
	$row = $query->fetch_assoc();
	$name = $row['name'];

	return $name;
	
}

function district_select($id){

	//Database Connection
	require DB_CONNECTION;

	$query = $db->query("SELECT * FROM `location` WHERE `id` = '$id' ");
	$row = $query->fetch_assoc();
	$name = $row['name'];

	return $name;
	
}

function city_select($id){

	//Database Connection
	require DB_CONNECTION;

	$query = $db->query("SELECT * FROM `location` WHERE `id` = '$id' ");
	$row = $query->fetch_assoc();
	$name = $row['name'];

	return $name;
	
}

function location_select($id){

	//Database Connection
	require DB_CONNECTION;

	$query = $db->query("SELECT * FROM `location` WHERE `id` = '$id' ");
	$row = $query->fetch_assoc();
	$name = $row['name'];

	return $name;
	
}





?>