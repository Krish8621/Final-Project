<?php

require 'config.php';

//Page Title
$page = 'PRODUCT SUB CATEGORY';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;

//Product Category List
$list = '';

$query = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `level` = 2 ORDER BY `id` ASC ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id = $row['id'];
    	$type = $row['type'];
    	$parent_id = $row['parent_id'];

    	$query_c = $db->query("SELECT * FROM `product_category` WHERE `id` = '$parent_id' ");
    	$row_c = $query_c->fetch_assoc();
    	$category = $row_c['type'];

$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td>$type</td>
	<td class="text-center">$category</td>
	<td class="actions text-center">
		<a href="product-category-sub?change=$id" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
		<a href="product-category-sub?delete=$id" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
DATA;
    }
}


//Add Product Category to DB

$msg = '';

if ( isset($_POST['add']) ) {
	
	$category_id 	= $_POST['category_id'];
	$type 			= $_POST['type'];

	$db->query("INSERT INTO `product_category`( `parent_id`, `type`, `level`, `status`) VALUES ('$category_id', '$type', 2, 1)");

$msg .= <<<MSG
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Success!</strong> New Product Sub Category Created!
</div>
MSG;

	header('refresh:1');


}

$input_hidden = '';
//Get Product Category cahnge data
if ( isset($_GET['change']) ) {

	$get_id 		= $_GET['change'];

	$query = $db->query("SELECT * FROM `product_category` WHERE `id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){
	    	$tmp_id = $row['id'];
	    	$tmp_parent_id = $row['parent_id'];
    		$tmp_type = $row['type'];
	    }
	}

	$btn = '<button type="submit" name="update" class="btn btn-primary btn-block">UPDATE</button>';
	$label = 'Update';

	$input_hidden = '<input type="text" name="tmp_id" value="'.$tmp_id.'" style="display:none;">';

}else{
	$btn = '<button type="submit" name="add" class="btn btn-primary btn-block">ADD</button>';
	$label = 'Add New';
}

//Update Product Category
if ( isset($_POST['update']) ) {

	$get_id 			= $_POST['tmp_id'];
	$get_type 			= $_POST['type'];
	$get_parent_id	= $_POST['parent_id'];

	$query = $db->query("UPDATE `product_category` SET `parent_id`= '$get_parent_id', `type`= '$get_type' WHERE `id`= '$get_id' ");

	header('location:product-category-sub');

}


//Fetch all Product Categories
$cat_list = '';

$query_pro_cat = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `level` = 1 ");
$rowCount_pro_cat = $query_pro_cat->num_rows;
if($rowCount_pro_cat > 0){	

    while($row_pro_cat = $query_pro_cat->fetch_assoc()){
    	$id_pro = $row_pro_cat['id'];
    	$type_pro = $row_pro_cat['type'];

    	$selected = ( $id_pro == $tmp_parent_id ) ? 'selected' : '';


$cat_list .= <<<EOD
<option value="$id_pro" $selected>$type_pro</option>
EOD;
    } 
}


if (isset($_GET['delete'])) {

	$del_id 	= $_GET['delete'];
	$del_table 	= "product_category_sub";
	
	delete($del_id, $del_table);

	header('location:product-category-sub');

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
							<?php echo $tmp_category_id; ?>
							<section class="panel">
								<div class="panel-body">
									<form class="form-horizontal form-bordered" method="POST">
										<div class="form-group">
											<label class="col-md-2 control-label" for="type"><?php echo $label; ?></label>
											<div class="col-md-4">
												<select class="form-control mb-md" name="parent_id" >
													<?php echo $cat_list; ?>
												</select>
											</div>
											<div class="col-md-4">
												<input type="text" class="form-control" id="type" name="type" value="<?php echo $tmp_type; ?>">
											</div>
											<div class="col-md-2">
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
					
							<h2 class="panel-title">PRODUCT SUB CATEGORY</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 50%;">Type</th>
										<th class="text-center" style="width: 30%;">Category</th>
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