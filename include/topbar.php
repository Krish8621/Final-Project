<?php

if (isset( $_COOKIE['service_type'] )) {

	$get_service_type = $_COOKIE['service_type'];

	if ( $get_service_type == 'service_assemble' ) {

		$service_type = 'PC ASSEMBLE';

	}elseif ( $get_service_type == 'service_part' ) {

		$service_type = 'PC PART';

	}elseif ( $get_service_type == 'service_service' ) {

		$service_type = 'SERVICE';

	}

}

$nav_list = '';

if ( isset($_COOKIE['web_user_id']) ) {

	$user_id = $_COOKIE['web_user_id'];

	$query = $db->query("SELECT * FROM `user` WHERE `id` = '$user_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){

	    	$id = $row['id'];
	    	$level_id = $row['level_id'];

	    	// 1	= 	Admin
	    	// 2	= 	Vendor
	    	// 3	= 	Technician
	    	// 4	= 	User

	    	if ( $level_id == 4 ) {

$nav_list .= <<<NAV
<li><a href="assemble">MY ITEMS $assemble_item_count</a></li>
<li><a href="profile"> MY PROFILE </a></li>
<li><a href="logout"> LOGOUT </a></li>
NAV;
	    	}else {

$nav_list .= <<<NAV
<li><a href="profile"> MY PROFILE </a></li>
<li><a href="system/">SYSTEM</a></li>
<li><a href="logout"> LOGOUT </a></li>
NAV;
	    		
	    	}

	    }
	}
}else{

$nav_list .= <<<NAV
<li><a href="login">LOGIN</a></li>
<li><a href="register">REGISTER</a></li>
NAV;

}

?>

<?php include 'include/alert.php'; ?>

<div class="top-bar">
	<div class="container-full">
		<p class="service-type-p"><i class="icon-arrow-right"></i> 
			<?php echo $service_type; ?>
			<a href="?change_service_type=true">Change</a>
		</p>

	<!-- Login Info -->
		<div class="login-info">
			<ul>
				<?php echo $nav_list; ?>				
			</ul>
		</div>
	</div>
</div>