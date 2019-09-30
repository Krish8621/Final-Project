<?php

require 'config.php';

//Page Title
$page = 'ADD NEW PRODUCT ITEM DETAILS';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;

//Fetch all Product Brands
$list_brand = '';

$query_brand = $db->query("SELECT * FROM `product_brand` WHERE `status` = 1 ");
$rowCount_brand = $query_brand->num_rows;
if($rowCount_brand > 0){
    while($row_brand = $query_brand->fetch_assoc()){
    	$id_brand = $row_brand['id'];
    	$title_brand = $row_brand['title'];

$list_brand .= <<<EOD
<option value="$id_brand">$title_brand</option>
EOD;
    } 
}

//Fetch all Product Categories
$list_category = '';

$query_category = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `parent_id` = 0 ");
$rowCount_category = $query_category->num_rows;
if($rowCount_category > 0){
    while($row_category = $query_category->fetch_assoc()){
    	$id_category = $row_category['id'];
    	$type_category = $row_category['type'];

$list_category .= <<<EOD
<option value="$id_category">$type_category</option>
EOD;
    } 
}



//Add Vendor to DB

$msg = '';

if ( isset($_POST['add']) ) {
	
	$brand 			= $_POST['brand'];
	$category 		= $_POST['category'];
	$sub_category 	= $_POST['sub_category'];
	$title 			= $_POST['title'];
	$description 	= $_POST['description'];


	$db->query("INSERT INTO `product_items`( `brand_id`, `category_id`, `sub_category_id`, `title`, `description`, `status`) VALUES ('$brand', '$category', '$sub_category', '$title', '$description', 1)");

	$last_id = $db->insert_id;


	$label_id 	= $_REQUEST['label_id'];
	$label_value 	= $_REQUEST['label_value'];

	$i = 0;
	
	foreach($label_value as $value){

		$tmp_label_id = $label_id[$i];
		$tmp_label_value = $label_value[$i];

		$db->query("INSERT INTO `product_item_label_type`( `product_item_id`, `product_label_id`, `type`, `status`) VALUES ('$last_id', '$tmp_label_id', '$tmp_label_value', 1 )");

		$i ++;
	}

$msg .= <<<MSG
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Success!</strong> New Product Item Created!
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
						
										<h2 class="panel-title">Add New Product Item</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" method="POST">
											<div class="form-group">
												<label class="col-md-3 control-label" for="brand">Brand</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="brand" id="brand">
														<option>Select</option>
														<?php echo $list_brand; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="category">Category</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="category" id="category">
														<option>Select</option>
														<?php echo $list_category; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="sub_category">Sub Category</label>
												<div class="col-md-6">
													<select class="form-control mb-md" name="sub_category" id="sub_category">
														<option>Select Category First</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="title">Title</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="title" name="title">
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="description">Description</label>
												<div class="col-md-6">
													<textarea class="form-control" id="description" name="description"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="title">Label</label>
												<div class="col-md-9">
													<div class="row field-option">	
													</div>
													<div class="row">
														<a href="javascript:void(0);" class="btn btn-primary add-option" style=""><i class="fa fa-plus" style="margin: 0;"></i></a>
													</div>
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

				$('#category').on('change', function(){

					var id = $(this).val();

					$.ajax({
			            url:'ajax-product.php',
			            type:'POST',
			            data:'type=get_sub_category_data&id='+id,
			            success:function (data) {
			            	$('#sub_category').html(data);
			            }
			        });

				});

			});
			
		</script>

		<script type="text/javascript">
			$(document).ready(function(){
				var maxField = 50; 
				var x = 0; 

				var addButton = $('.add-option'); 
				var wrapper = $('.field-option'); 
				
				
				$(addButton).click(function(){

					var newInput = x;

					$.ajax({
			            url:'ajax-product.php',
			            type:'POST',
			            data:'new_other='+newInput,
			            success:function (data) {
			            	var fieldHTML = data;
			                if(x < maxField){
								x++; 
								$(wrapper).append(fieldHTML); 
							}
			            }
			        });
					
				});
				$(wrapper).on('click', '.remove-option-other', function(e){ 
					e.preventDefault();
					$(this).parent('div').remove(); 
					x--; 
				});
			});
		</script>

	</body>
</html>