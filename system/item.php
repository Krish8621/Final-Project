<?php

require 'config.php';

//Page Title
$page = 'ITEM DETAILS';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;


//Product Item Details List
$list = '';

$query = $db->query("SELECT * FROM `item` WHERE `status` = 1 ORDER BY `id` DESC ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id = $row['id'];
    	$vendor_id = $row['vendor_id'];
    	$item_id = $row['item_id'];
    	$amount = $row['amount'];

    	$label_1 = $row['label_1'];
    	$label_2 = $row['label_2'];
    	$label_3 = $row['label_3'];
    	$label_4 = $row['label_4'];
    	$label_5 = $row['label_5'];

    	//label 01
    	$query_l_1 = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_1' ");
    	$row_l_1 = $query_l_1->fetch_assoc();
    	$label_l_1 = $row_l_1['type'];

    	//label 02
    	$query_l_2 = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_2' ");
    	$row_l_2 = $query_l_2->fetch_assoc();
    	$label_l_2 = ( $row_l_2['type'] > 0 ) ? ' - '.$row_l_2['type'] : '';

    	//label 03
    	$query_l_3 = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_3' ");
    	$row_l_3 = $query_l_3->fetch_assoc();
    	$label_l_3 = ( $row_l_3['type'] > 0 ) ? ' - '.$row_l_3['type'] : '';

    	//label 04
    	$query_l_4 = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_4' ");
    	$row_l_4 = $query_l_4->fetch_assoc();
    	$label_l_4 = ( $row_l_4['type'] > 0 ) ? ' - '.$row_l_4['type'] : '';

    	//label 05
    	$query_l_5 = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_5' ");
    	$row_l_5 = $query_l_5->fetch_assoc();
    	$label_l_5 = ( $row_l_5['type'] > 0 ) ? ' - '.$row_l_5['type'] : '';

    	$all_labels = $label_l_1 . $label_l_2 . $label_l_3 . $label_l_4 . $label_l_5;


    	//Product Item
    	$query_i = $db->query("SELECT * FROM `product_items` WHERE `id` = '$item_id' ");
    	$row_i = $query_i->fetch_assoc();
    	$item_title = $row_i['title'];
    	$item_brand_id = $row_i['brand_id'];
    	$item_category_id = $row_i['category_id'];
    	$item_sub_category_id = $row_i['sub_category_id'];

    	//Product Brand
    	$query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$item_brand_id' ");
    	$row_b = $query_b->fetch_assoc();
    	$brand_name = $row_b['title'];

    	//Product Category
    	$query_c = $db->query("SELECT * FROM `product_category` WHERE `id` = '$item_category_id' ");
    	$row_c = $query_c->fetch_assoc();
    	$category_name = $row_c['type'];

    	//Product Sub Category
    	$query_s = $db->query("SELECT * FROM `product_category` WHERE `id` = '$item_sub_category_id' ");
    	$row_s = $query_s->fetch_assoc();
    	$sub_category_name = $row_s['type'];

$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td>$item_title - $brand_name - $category_name - $sub_category_name - $all_labels</td>
	<td class="actions text-center">
		<a href="#" class="on-default cancel-row"><i class="fa fa-search"></i></a>
		<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
		<a href="#" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
DATA;
    }
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
					
							<h2 class="panel-title">ITEM DETAILS</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 80%;">Description</th>
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