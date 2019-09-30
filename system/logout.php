<?php

if ($_GET['log_id'] && $_GET['log_id'] == 'true' ) {
	if (isset($_COOKIE['username'])) {
		session_destroy();
		setcookie("username", '', time() - 36000);	
		setcookie("user_level", '', time() - 36000);
		setcookie("name", '', time() - 36000);
		setcookie("user_id", '', time() - 36000);		
		header("location:login");
		header('refresh:0');
	}
}
		
?>
