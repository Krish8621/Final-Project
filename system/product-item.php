<?php

require 'config.php';

//Page Title
$page = 'PRODUCT ITEM DETAILS';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;


//Product Item Details List
$list = '';

$query = $db->query("SELECT * FROM `product_items` WHERE `status` = 1 ORDER BY `title` ASC ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id = $row['id'];
    	$brand_id = $row['brand_id'];
    	$category_id = $row['category_id'];
    	$sub_category_id = $row['sub_category_id'];
    	$title = $row['title'];

    	//Product Brand
    	$query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$brand_id' ");
    	$row_b = $query_b->fetch_assoc();
    	$brand_name = $row_b['title'];

    	//Product Category
    	$query_c = $db->query("SELECT * FROM `product_category` WHERE `id` = '$category_id' ");
    	$row_c = $query_c->fetch_assoc();
    	$category_name = $row_c['type'];

    	//Product Sub Category
    	$query_s = $db->query("SELECT * FROM `product_category` WHERE `id` = '$sub_category_id' ");
    	$row_s = $query_s->fetch_assoc();
    	$sub_category_name = $row_s['type'];

$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td>$title</td>
	<td class="text-center">$brand_name</td>
	<td class="text-center">$category_name</td>
	<td class="text-center">$sub_category_name</td>
	<td class="actions text-center">
		<a href="#" class="on-default cancel-row"><i class="fa fa-search"></i></a>
		<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
		<a href="product-item?delete=$id" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
DATA;
    }
}

if (isset($_GET['delete'])) {

	$del_id 	= $_GET['delete'];
	$del_table 	= "product_items";
	
	delete($del_id, $del_table);

	header('location:product-item');

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
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
								<a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
							</div>
					
							<h2 class="panel-title">PRODUCT ITEM DETAILS</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 25%;">Title</th>
										<th class="text-center" style="width: 20%;">Brand</th>
										<th class="text-center" style="width: 20%;">Category</th>
										<th class="text-center" style="width: 20%;">Sub Category</th>
										<th style="width: 10%;"></th>
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