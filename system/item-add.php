<?php

require 'config.php';

//Page Title
$page = 'ADD NEW ITEM';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;



//Fetch all Product Items
$item_list = '';

$query_pro_items = $db->query("SELECT * FROM `product_items` WHERE `status` = 1 ");
$rowCount_pro_items = $query_pro_items->num_rows;
if($rowCount_pro_items > 0){
    while($row_pro_item = $query_pro_items->fetch_assoc()){
    	$pro_item_id = $row_pro_item['id'];
    	$pro_item_brand_id = $row_pro_item['brand_id'];
    	$pro_item_cat_id = $row_pro_item['category_id'];
    	$pro_item_sub_cat_id = $row_pro_item['sub_category_id'];
    	$pro_item_title = $row_pro_item['title'];

    	//Product Brand
    	$query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$pro_item_brand_id' ");
    	$row_b = $query_b->fetch_assoc();
    	$brand_name = $row_b['title'];

    	//Product Category
    	$query_c = $db->query("SELECT * FROM `product_category` WHERE `id` = '$pro_item_cat_id' ");
    	$row_c = $query_c->fetch_assoc();
    	$category_name = $row_c['type'];

    	//Product Sub Category
    	$query_s = $db->query("SELECT * FROM `product_category` WHERE `id` = '$pro_item_sub_cat_id' ");
    	$row_s = $query_s->fetch_assoc();
    	$sub_category_name = $row_s['type'];

$item_list .= <<<EOD
<option value="$pro_item_id">$pro_item_title - $brand_name - $category_name - $sub_category_name </option>
EOD;
    } 
}



//Add Vendor to DB

$msg = '';

if ( isset($_POST['add']) ) {

	$data = $_POST['data'];
	$tmp = 1;
	$data_val = '';
	
	$query_tmp = '';
	$query_val_tmp = '';
	foreach ($data as $value ) {

		$comma = ( $tmp != 1 ) ? ', ' : '' ;

		$query_tmp .= $comma.'`label_'.$tmp.'`';
		$query_val_tmp .= $comma."'".$value."'";

		$tmp ++;
	}


	
	$vendor_id 			= $_COOKIE['user_id'];
	$product_item_id 	= $_POST['product_item_id'];
	$amount 			= $_POST['amount'];
	$compatible_1		= $_POST['compatible_1'];
	$compatible_2		= $_POST['compatible_2'];

	$sql_query = 'INSERT INTO `item`(`vendor_id`, `item_id`, '; 
	$sql_query .= $query_tmp.', `amount`, `compatible_1`, `compatible_2`, `available_status`, `status`)';
	$sql_query .= " VALUES ('$vendor_id', '$product_item_id', $query_val_tmp, '$amount', '$compatible_1', '$compatible_2', 1 , 1 )";

	$db->query($sql_query);

$msg .= <<<MSG
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong>Success!</strong> New Item Details Added!
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
						
										<h2 class="panel-title">Add New Item</h2>
									</header>
									<div class="panel-body">
										<form class="form-horizontal form-bordered" method="POST">
											
											<div class="form-group">
												<label class="col-md-3 control-label" for="pro-item">Product Item</label>
												<div class="col-md-9">
													<select class="form-control mb-md" name="product_item_id" id="pro-item">
														<option>Select</option>
														<?php echo $item_list; ?>
													</select>
												</div>
											</div>	

											<div id="label-data">
												
											</div>										
											
												

											<div class="form-group">
											</div>
											<div class="form-group">
												<label class="col-md-3 control-label" for="amount">Amount</label>
												<div class="col-md-6">
													<input type="text" class="form-control" id="amount" name="amount" autocomplete="off">
												</div>
											</div>

											<div id="compare-data">
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

				$('#pro-item').on('change', function(){

					var id = $(this).val();

					$.ajax({
			            url:'ajax-item.php',
			            type:'POST',
			            data:'type=get_all_label_data&id='+id,
			            success:function (data) {
			            	$('#label-data').html(data);
			            }
			        });

			        $.ajax({
			            url:'ajax-item.php',
			            type:'POST',
			            data:'type=get_compare_data&id='+id,
			            success:function (data) {
			            	$('#compare-data').html(data);
			            }
			        });

				});

			});
			
		</script>

	</body>
</html>