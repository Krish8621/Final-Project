<?php
include 'config.php';


/*START - SET COOKIE*/

if ( isset($_POST['type']) && $_POST['type'] == 'set_location_province' ) {

	$get_id = $_POST['id'];

	setcookie("province", $get_id, 0);
	setcookie("district", '', time() - 36000); 
	setcookie("city", '', time() - 36000);

}

if ( isset($_POST['type']) && $_POST['type'] == 'set_location_district' ) {

	$get_id = $_POST['id'];

	setcookie("district", $get_id, 0);
	setcookie("city", '', time() - 36000);  

}

if ( isset($_POST['type']) && $_POST['type'] == 'set_location_city' ) {

	$get_id = $_POST['id'];

	setcookie("city", $get_id, 0);

}

if ( isset($_POST['type']) && $_POST['type'] == 'set_sub_category' ) {

	$get_id = $_POST['id'];
	setcookie("sub_category", $get_id, 0); 

}

if ( isset($_POST['type']) && $_POST['type'] == 'set_vendor' ) {

	$get_id = $_POST['id'];
	setcookie("vendor", $get_id, 0); 

}

/*END - SET COOKIE*/


/*START - CLEAR COOKIE*/

if ( isset($_POST['type']) && $_POST['type'] == 'clear_location_province' ) {

	setcookie("province", '', time() - 36000);
	setcookie("district", '', time() - 36000); 
	setcookie("city", '', time() - 36000); 

}

if ( isset($_POST['type']) && $_POST['type'] == 'clear_location_district' ) {

	setcookie("district", '', time() - 36000); 
	setcookie("city", '', time() - 36000); 

}

if ( isset($_POST['type']) && $_POST['type'] == 'clear_location_city' ) {

	setcookie("city", '', time() - 36000); 

}



if ( isset($_POST['type']) && $_POST['type'] == 'clear_sub_category' ) {

	setcookie("sub_category", '', time() - 36000);  

}

if ( isset($_POST['type']) && $_POST['type'] == 'clear_vendor' ) {

	setcookie("vendor", '', time() - 36000);  

}

/*END - CLEAR COOKIE*/

?>