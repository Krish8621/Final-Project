<?php
require 'admin/connection.php';

if ( !isset($_COOKIE['username']) ) {
	header('location:login');
}

if (isset($_COOKIE['username'])) {
	$get_username = $_COOKIE['username'];
	$query = $db->query("SELECT * FROM `user` WHERE `username` = '$get_username'");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        while($row = $query->fetch_assoc()){
        	$user_id = $row['id'];
        	$user_get_level = $row['level_id'];
        	$user_get_status = $row['status'];
        }        
		/*STATUS TYPES
		-------------------
        Pending 		0
        Active 			1
        Deactivated 	2
        Blacklisted		3
        -------------------
        */
        if ( $user_get_status != 1 ) {
        	//redirect to error page
        	$location = 'location:page-error?eid='.$user_get_status.'&&fid='.$fake_link;
        	header($location);
		}elseif ( $user_get_status == 1 ) {
			
			define('USER_LEVEL', $user_get_level);

			header('location:./');
		}
    }
		
}
?>