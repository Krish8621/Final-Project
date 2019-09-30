<?php

if (isset($_COOKIE['web_user_id'])) {
	session_destroy();
	setcookie("web_user_id", '', time() - 36000);		
	header("location:./");
	header('refresh:0');
}else{
	header("location:./");
}
		
?>
