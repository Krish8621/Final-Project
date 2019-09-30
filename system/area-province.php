<?php

require 'config.php';

//Page Title
$page = 'PROVINCES';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;


//Province List
$list = '';

$query = $db->query("SELECT * FROM `location` WHERE `status` = 1 AND `level` = 1 ORDER BY `id` ASC ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id = $row['id'];
    	$name = $row['name'];

$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td>$name</td>
	<td class="actions text-center">
		<a href="area-province?change=$id" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
		<a href="area-province?delete=$id" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
DATA;
    }
}


//Add Product Category to DB

$msg = '';

if ( isset($_POST['add']) ) {
	
	$name 		= $_POST['name'];

	$db->query("INSERT INTO `location`(`parent_id`, `name`, `level`, `status`) VALUES (0, '$name', 1, 1)");

$msg .= <<<MSG
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Success!</strong> New Province Created!
</div>
MSG;

	header('refresh:1');


}

$input_hidden = '';
//Get Product Category cahnge data
if ( isset($_GET['change']) ) {

	$get_id 		= $_GET['change'];

	$query = $db->query("SELECT * FROM `location` WHERE `id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){
	    	$tmp_id = $row['id'];
    		$tmp_name = $row['name'];
	    }
	}

	$btn = '<button type="submit" name="update" class="btn btn-primary btn-block">UPDATE</button>';
	$label = 'Update Province';

	$input_hidden = '<input type="text" name="tmp_id" value="'.$tmp_id.'" style="display:none;">';

}else{
	$btn = '<button type="submit" name="add" class="btn btn-primary btn-block">ADD</button>';
	$label = 'Add New Province';
}

//Update Product Category
if ( isset($_POST['update']) ) {

	$get_id 		= $_POST['tmp_id'];
	$get_name		= $_POST['name'];

	$query = $db->query("UPDATE `location` SET `name`= '$get_name' WHERE `id`= '$get_id' ");

	header('location:area-province');

}


if (isset($_GET['delete'])) {

	$del_id 	= $_GET['delete'];
	$del_table 	= "location";
	
	delete($del_id, $del_table);

	header('location:area-province');

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
								<div class="panel-body">
									<form class="form-horizontal form-bordered" method="POST">
										<div class="form-group">
											<label class="col-md-3 control-label" for="name"><?php echo $label; ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="name" name="name" value="<?php echo $tmp_name; ?>">
											</div>
											<div class="col-md-3">
												<?php echo $input_hidden; ?>
												<?php echo $btn; ?>
											</div>
										</div>
									</form>
								</div>
							</section>					
						</div>
					</div>
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
							</div>
					
							<h2 class="panel-title">PROVINCES</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 80%;">Name</th>
										<th style="width: 15%;"></th>
									</tr>
								</thead>
								<tbody>
									<?php echo $list; ?>
								</tbody>
							</table>
						</div>
					</section>
					<!-- end: page -->
				</section>
			</div>
		</section>

		<?php include 'include/footer.php'; ?>

	</body>
</html>