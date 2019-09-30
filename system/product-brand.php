<?php

require 'config.php';

//Page Title
$page = 'PRODUCT BRAND';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;


//Product Category List
$list = '';

$query = $db->query("SELECT * FROM `product_brand` WHERE `status` = 1 ORDER BY `id` ASC ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id = $row['id'];
    	$title = $row['title'];

$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td>$title</td>
	<td class="actions text-center">
		<a href="product-brand?change=$id" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
		<a href="product-brand?delete=$id" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
DATA;
    }
}


//Add Product Category to DB

$msg = '';

if ( isset($_POST['add']) ) {
	
	$title 		= $_POST['title'];

	$db->query("INSERT INTO `product_brand`( `title`, `status`) VALUES ('$title', 1)");

$msg .= <<<MSG
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Success!</strong> New Product Brand Created!
</div>
MSG;

	header('refresh:1');


}

$input_hidden = '';
//Get Product Category cahnge data
if ( isset($_GET['change']) ) {

	$get_id 		= $_GET['change'];

	$query = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){
	    	$tmp_id = $row['id'];
    		$tmp_title = $row['title'];
	    }
	}

	$btn = '<button type="submit" name="update" class="btn btn-primary btn-block">UPDATE</button>';
	$label = 'Update Brand Title';

	$input_hidden = '<input type="text" name="tmp_id" value="'.$tmp_id.'" style="display:none;">';

}else{
	$btn = '<button type="submit" name="add" class="btn btn-primary btn-block">ADD</button>';
	$label = 'Add New Brand Title';
}

//Update Product Category
if ( isset($_POST['update']) ) {

	$get_id 		= $_POST['tmp_id'];
	$get_title		= $_POST['title'];

	$query = $db->query("UPDATE `product_brand` SET `title`= '$get_title' WHERE `id`= '$get_id' ");

	header('location:product-brand');

}

if (isset($_GET['delete'])) {

	$del_id 	= $_GET['delete'];
	$del_table 	= "product_brand";
	
	delete($del_id, $del_table);

	header('location:product-brand');

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
											<label class="col-md-3 control-label" for="title"><?php echo $label; ?></label>
											<div class="col-md-6">
												<input type="text" class="form-control" id="title" name="title" value="<?php echo $tmp_title; ?>">
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
					
							<h2 class="panel-title">PRODUCT BRAND</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 80%;">Type</th>
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