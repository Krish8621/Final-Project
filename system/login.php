<?php

require 'admin/connection.php';

//Page Title
$page = 'ADMIN DASHBOARD';


if (isset($_POST['login'])){

    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    $query = $db->query("SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password' ");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        while($row = $query->fetch_assoc()){
        	$get_user_id = $row['id'];
            $get_username = $row['username'];
            $get_password = $row['password'];
            $get_status = $row['status']; 
            $get_level = $row['level_id'];
            $get_name = $row['name']; 
        }
        if( strcmp($username , $get_username) == 0 && strcmp($password , $get_password) == 0 ) {
        	setcookie("user_id", $get_user_id, 0);
            setcookie("username", $get_username, 0); 
            setcookie("name", $get_name, 0);
            setcookie("user_level", $get_level, 0);             
            session_start(['cookie_lifetime' => 36000,]);
            header("location:access");
        }else{
            $error_msg = '<h5 class="text-danger text-center" style="font-weight: bold;">Incorrect Username or Password!</h5>';
        }
    }else{
        $error_msg = '<h5 class="text-danger text-center" style="font-weight: bold;">Incorrect Username or Password!</h5>';
    }
}
?>

?>
<!doctype html>
<html class="fixed">
	<head>
		<?php include 'include/head.php'; ?>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<form method="POST">
							<?php echo $error_msg; ?>
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" style="font-size: 130%;font-weight: bold;" autocomplete="off" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" style="font-size: 130%;font-weight: bold;" autocomplete="off"/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" name="login" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" name="login" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<!-- end: page -->

		<?php include 'include/footer.php'; ?>

	</body>
</html>