<?php

require 'config.php';

//Page Title
$page = 'ADD NEW VENDOR';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;

//Fetch all Provinces
$list = '';

$query_province = $db->query("SELECT * FROM `location` WHERE `status` = 1 ");
$rowCount_province = $query_province->num_rows;
if($rowCount_province > 0){
    while($row_p = $query_province->fetch_assoc()){
    	$province_id = $row_p['id'];
    	$province_name = $row_p['name'];

$list .= <<<EOD
<option value="$province_id">$province_name</option>
EOD;
    } 
}



//Add Vendor to DB

$msg = '';

if ( isset($_POST['add']) ) {
	
	$name 		= $_POST['name'];
	$contact 	= $_POST['contact'];
	$email 		= $_POST['email'];
	$province 	= $_POST['province'];
	$district 	= $_POST['district'];
	$city 		= $_POST['city'];

	$password = 123;
	$password = sha1($password);

	$db->query("INSERT INTO `user`(`username`, `password`, `name`, `contact`, `location_id`, `province_id`, `district_id`, `city_id`, `level_id`, `status`) VALUES ('$email', '$password', '$name', '$contact', '$city', '$province', '$district', '$city', 2, 1 )");
	

$msg .= <<<MSG
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Success!</strong> New Vendor Created!
</div>
MSG;

	header('refresh:1');


}

?>
<!doctype html>
<html class="fixed">
	<head>
		<?php include 'include/head.php'; ?>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include 'include/header.php'; ?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include 'include/sidebar.php'; ?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<?php include 'include/breadcrumb.php'; ?>				

					<!-- start: page -->
					<div class="row">
							<div class="col-lg-12">
								<?php echo $msg; ?>
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
											<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
										</div>
						
										<h2 class="panel-title">Add New Vendor</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" method="POST">
											<div class="form-group">
												<label class="col-md-3 control-label" for="name">Name</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="name" name="name">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="contact">Contact</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="contact" name="contact">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="email">Email</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="email" name="email">
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label" for="province">Province</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="province" id="province">
														<option>Select</option>
														<?php echo $list; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="district">District</label>
												<div class="col-md-6">
													<select class="form-control mb-md district-data" name="district" id="district">														
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="city">City</label>
												<div class="col-md-6">
													<select class="form-control mb-md city-data" name="city" id="city">
													</select>
												</div>
											</div>

											<div class="form-group">
												<div class="col-md-3">
												</div>
												<div class="col-md-6">
													<button type="submit" name="add" class="btn btn-primary btn-block">ADD</button>
												</div>
											</div>

											

										</form>
									</div>
								</section>					
							</div>
						</div>
					<!-- end: page -->
				</section>
			</div>
		</section>

		<?php include 'include/footer.php'; ?>

		<script type="text/javascript">

			$(document).ready( function(){

				$('#province').on('change', function(){

					var id = $(this).val();

					$.ajax({
			            url:'ajax-vendor.php',
			            type:'POST',
			            data:'type=get_distict_data&id='+id,
			            success:function (data) {
			            	$('.district-data').html(data);
			            }
			        });

				});


				$('#district').on('change', function(){

					var id = $(this).val();

					$.ajax({
			            url:'ajax-vendor.php',
			            type:'POST',
			            data:'type=get_city_data&id='+id,
			            success:function (data) {
			            	$('.city-data').html(data);
			            }
			        });

				});

			});
			
		</script>

	</body>
</html>