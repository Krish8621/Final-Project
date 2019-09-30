<?php

require 'config.php';

//Page Title
$page = 'ORDER VIEW';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;
$get_level = $_COOKIE['user_level'];
$user_id = $_COOKIE['user_id'];
$get_job_id = $_GET['order_id'];


if ( isset($_POST['save']) ) {

	$now = date('Y-m-d H:i:s',time());

	$tmp_id = $_POST['tmp_id'];


	$tmp_approve_status = $_POST['approve'];
	$tmp_complete_status = $_POST['progress'];
	$tmp_delivered_status = $_POST['delivery_status'];
	$tmp_payment_status = $_POST['payment_status'];
	$tmp_delivery_amount = $_POST['delivery_cost'];
	$tmp_travelling_amount = $_POST['travel_cost'];
	$tmp_other_amount = $_POST['other_expenses'];


	$sql = "UPDATE `job` SET `tech_id`= '$user_id'";

	if ( isset($tmp_approve_status) ) {
		$sql .= ",`approve_status`= '$tmp_approve_status', `approve_time`= '$now'";
	}

	if ( isset($tmp_complete_status) ) {
		$sql .= ",`complete_status`= '$tmp_complete_status', `complete_time`= '$now'";
	}

	if ( isset($tmp_delivered_status) ) {
		$sql .= ",`delivered`= '$tmp_delivered_status', `delivered_time`= '$now'";
	}

	if ( isset($tmp_payment_status) ) {
		$sql .= ",`payment`= '$tmp_payment_status', `payment_time`= '$now'";
	}

	if ( isset($tmp_delivery_amount) ) {
		$sql .= ",`delivery_amount`= '$tmp_delivery_amount'";
	}

	if ( isset($tmp_travelling_amount) ) {
		$sql .= ",`travelling_amount`= '$tmp_travelling_amount'";
	}

	if ( isset($tmp_other_amount) ) {
		$sql .= ",`other_amount`= '$tmp_other_amount'";
	}

	$sql .= " WHERE `id` = '$tmp_id' ";

	$db->query($sql);
	//header('location:order-view?order_id='.$tmp_id);

}	




$query = $db->query("SELECT * FROM `job` WHERE `id` = '$get_job_id' ");
$rowCount = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

    	$id = $row['id'];
    	$tech_id = $row['tech_id'];
    	$client_id = $row['client_id'];
    	$delivery = $row['delivery'];
    	$add_time = date('d - M - Y' , strtotime($row['add_time']) );    	
    	$approve_status = $row['approve_status'];
    	$approve_time = date('d - M - Y' , strtotime($row['approve_time']) );

    	$complete_status = $row['complete_status'];
    	$complete_time = date('d - M - Y' , strtotime($row['complete_time']) );

    	$complete_status = $row['complete_status'];
    	$complete_time = date('d - M - Y' , strtotime($row['complete_time']) );

    	$delivered_status = $row['delivered'];
    	$delivered_time = date('d - M - Y' , strtotime($row['delivered_time']) );

    	$recieved_status = $row['recieved'];
    	$recieved_time = date('d - M - Y' , strtotime($row['recieved_time']) );

    	$payment_status = $row['payment'];
    	$payment_time = date('d - M - Y' , strtotime($row['payment_time']) );


    	$manage_btn = '<a href="model-job-edit?id='.$id.'" class="btn btn-primary simple-ajax-modal">MANAGE</a>';

    	if ( $tech_id != $user_id ) {

    		if ( $get_level != 1 ) {

    			header('location:order');

    		}

    		$manage_btn = '';    		
    	}


    	$job_amount = $row['job_amount'];
    	$delivery_amount = $row['delivery_amount'];
    	$travelling_amount = $row['travelling_amount'];
    	$other_amount = $row['other_amount'];

$status_data = '';

if ( $approve_status != 0 ) {

	if ( $approve_status == 1 ) {
		$status_data_lbl = 'Approved Date';
	}elseif ( $approve_status == 2 ) {
		$status_data_lbl = 'Declined Date';
	}	

$status_data .= <<<EOD
<p class="mb-none">
	<span class="text-dark">$status_data_lbl:</span>
	<span class="value">$approve_time</span>
</p>
EOD;
}

$complete_status_data = '';

if ( $complete_status == 1 ) {

$complete_status_data .= <<<EOD
<p class="mb-none">
	<span class="text-dark">Completed Date:</span>
	<span class="value">$complete_time</span>
</p>
EOD;
}

$delivery_status_data = '';

if ( $delivered_status == 1 ) {

$delivery_status_data .= <<<EOD
<p class="mb-none">
	<span class="text-dark">Delivery Date:</span>
	<span class="value">$delivered_time</span>
</p>
EOD;
}

$recieved_status_data = '';

if ( $recieved_status == 1 ) {

$recieved_status_data .= <<<EOD
<p class="mb-none">
	<span class="text-dark">Recieved Date:</span>
	<span class="value">$recieved_time</span>
</p>
EOD;
}
		
		$job_id = $id;
    	$job_id_txt = str_pad($job_id,10,0,STR_PAD_LEFT);


    	if ( $approve_status == 0 ) {
    		$status_lbl       = 'PENDING';
            $status_lbl_class   = 'label-warning';
    	}elseif( $approve_status == 1 ){
            $status_lbl         = 'ACCEPTED';
            $status_lbl_class   = 'label-primary';
        }elseif( $approve_status == 2 ){
    		$status_lbl       = 'DECLINED';
            $status_lbl_class   = 'label-danger';
    	}


        if ( $approve_status == 1 ) {

            if ( $delivery == 1 ) {
                if ( $complete_status == 0 ) {
                    $progress_lbl         = 'ONGOING';
                    $progress_lbl_class   = 'label-primary';
                }elseif ( $complete_status == 1 && $delivered == 0  ) {
                    $progress_lbl         = 'DELIVERY PENDING';
                    $progress_lbl_class   = 'label-warning';
                }elseif ( $complete_status == 1 && $delivered == 1 ) {
                    $progress_lbl         = 'DONE';
                    $progress_lbl_class   = 'label-success';
                }
            }else{
                if ( $complete_status == 0 ) {
                    $progress_lbl         = 'ONGOING';
                    $progress_lbl_class   = 'label-primary';
                }elseif ( $complete_status == 1 ) {
                    $progress_lbl         = 'DONE';
                    $progress_lbl_class   = 'label-success';
                }
            }              
            
        }


        $query_client = $db->query("SELECT * FROM `user` WHERE `id` = '$client_id' ");
        $row_client = $query_client->fetch_assoc();
        $client_email = $row_client['username'];
        $client_name = strtoupper($row_client['name']);
        $client_contact = $row_client['contact'];
        $client_address = str_replace(',', '<br>', $row_client['address']);




$client_details = <<<EOD
<address>
	$client_name
	<br/>
	$client_email
	<br/>
	$client_contact 
	<br/>
	$client_address
</address>
EOD;

		$query_tech = $db->query("SELECT * FROM `user` WHERE `id` = '$tech_id' ");
        $row_tech = $query_tech->fetch_assoc();
        $tech_email = $row_tech['username'];
        $tech_name = strtoupper($row_tech['name']);
        $tech_contact = $row_tech['contact'];
        $tech_address = str_replace(',', '<br>', $row_tech['address']);


$technician_details = <<<EOD
<address>
	$tech_name
	<br/>
	$tech_email
	<br/>
	$tech_contact 
	<br/>
	$tech_address
</address>
EOD;




	}
}


$item_list = '';

$query = $db->query("SELECT * FROM `sale_assemble` WHERE `job_id` = '$job_id' ");
$rowCount = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

    	$item_id = $row['item_id'];
    	$tmp_amount = $row['item_purchase_amount'];


    	$tmp_amount_txt = number_format($tmp_amount, 2, '.', ',');

    	$query_item = $db->query("SELECT * FROM `item` WHERE `id` = '$item_id' ");
		$row_item = $query_item->fetch_assoc();

		$item_id = $row_item['id'];
		$product_item_id = $row_item['item_id'];
		$product_item_vendor_id = $row_item['vendor_id'];
		$product_item_cat_id = $row_item['category_id'];

		$label_1 = $row_item['label_1'];
    	$label_2 = $row_item['label_2'];
    	$label_3 = $row_item['label_3'];
    	$label_4 = $row_item['label_4'];
    	$label_5 = $row_item['label_5'];

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

		$query_product_item = $db->query("SELECT * FROM `product_items` WHERE `id` = '$product_item_id' ");
		$row_pro_item = $query_product_item->fetch_assoc();
		$product_item_title = $row_pro_item['title'];

		$query_product_category = $db->query("SELECT * FROM `product_category` WHERE `id` = '$product_item_cat_id' ");
		$row_pro_cat = $query_product_category->fetch_assoc();
		$product_cat_type = $row_pro_cat['type'];

		$query_vendor = $db->query("SELECT * FROM `user` WHERE `id` = '$product_item_vendor_id' ");
		$row_vendor = $query_vendor->fetch_assoc();
		$vendor_email = $row_vendor['username'];
		$vendor_name = $row_vendor['name'];
		$vendor_contact = $row_vendor['contact'];
		$vendor_address = str_replace(',', '<br>', $row_vendor['address']);


$item_list .= <<<DATA
<section class="toggle">
	<label>
		<div style="display: inline-block;width: 65%;">
			<span>$product_cat_type - $product_item_title - $all_labels</span>
		</div>
		<div style="float: right;margin: 0 10px;width: 30%;">
			<div style="display: inline-block;width: 40%;text-align: right;">$tmp_amount_txt </div>
			<div style="display: inline-block;width: 17%;text-align: right;">1</div>
			<div style="display: inline-block;width: 40%;text-align: right;">$tmp_amount_txt </div>
		</div>
	</label>
	<div class="toggle-content">
		<div class="col-md-6">
			<label>Features</label>
			<ul>
				<li>Specification<span style="float: right;width: 60%;">Intel Core i7</span></li>
				<li>Specification<span style="float: right;width: 60%;">Intel Core i7</span></li>
				<li>Specification<span style="float: right;width: 60%;">Intel Core i7</span></li>
				<li>Specification<span style="float: right;width: 60%;">Intel Core i7</span></li>
				<li>Specification<span style="float: right;width: 60%;">Intel Core i7</span></li>
			</ul>
		</div>
		<div class="col-md-6">
			<label>Vendor</label>
			<ul>
				<li>Name <span style="float: right;width: 75%;"><a href="javascript:void(0);">$vendor_name</a></span></li>
				<li>Contact <span style="float: right;width: 75%;">$vendor_contact</span></li>
				<li>email<span style="float: right;width: 75%;">$vendor_email</span></li>
				<li>Address 
					<span style="float: right;width: 75%;">
						$vendor_address
					</span>
				</li>
			</ul>
		</div>
			
	</div>
</section>
DATA;
    }
}


$tmp_amount_sub_tot_txt = number_format($job_amount, 2, '.', ',');


$tech_cost = 0;
$delivery_cost = $delivery_amount;
$travelling_cost = $travelling_amount;
$other_cost = $other_amount;

$tmp_amount_tot = $job_amount + $tech_cost + $delivery_cost + $travelling_cost + $other_cost;

$tmp_amount_tot_txt = number_format($tmp_amount_tot, 2, '.', ',');

$tech_cost_data = '';
if ( $tech_cost != 0 ) {
	$tech_cost_txt = number_format($tech_cost, 2, '.', ',');
$tech_cost_data .= <<<EOD
<tr>
	<td colspan="2">Technician</td>
	<td class="text-right">$tech_cost_txt</td>
</tr>
EOD;
}

$tech_cost_data = '';
if ( $tech_cost != 0 ) {
	$tech_cost_txt = number_format($tech_cost, 2, '.', ',');
$tech_cost_data .= <<<EOD
<tr>
	<td colspan="2">Technician</td>
	<td class="text-right">$tech_cost_txt</td>
</tr>
EOD;
}

$travel_cost_data = '';
if ( $travelling_amount != 0 ) {
	$travelling_amount_txt = number_format($travelling_amount, 2, '.', ',');
$travel_cost_data .= <<<EOD
<tr>
	<td colspan="2">Travelling Cost</td>
	<td class="text-right">$travelling_amount_txt</td>
</tr>
EOD;
}

$other_cost_data = '';
if ( $other_amount != 0 ) {
	$other_amount_txt = number_format($other_amount, 2, '.', ',');
$other_cost_data .= <<<EOD
<tr>
	<td colspan="2">Other Expenses</td>
	<td class="text-right">$other_amount_txt</td>
</tr>
EOD;
}

$delivery_cost_data = '';
if ( $delivery_amount != 0 ) {
	$delivery_amount_txt = number_format($delivery_amount, 2, '.', ',');
$delivery_cost_data .= <<<EOD
<tr>
	<td colspan="2">Delivery Cost</td>
	<td class="text-right">$delivery_amount_txt</td>
</tr>
EOD;
}

$payment_status_data = '';
if ( $payment_status == 1 ) {

	$payment_due_data = '';

	$tot_payment = 0;

	$payment_due = $tmp_amount_tot - $tot_payment;


	if ( $payment_due > 0 ) {

		$payment_due_txt = number_format($payment_due, 2, '.', ',');

$payment_due_data = <<<EOD
<p class="mb-none">
	<span class="text-danger">Due Amount:</span>
	<span class="value text-danger">$payment_due_txt</span>
</p>
EOD;
	}else{
		$payment_due_data = '';
	}

$payment_status_data .= <<<EOD
<p class="mb-none">
	<span class="text-dark">Payment:</span>
	<span class="value"><span class="label label-success">Recieved</span></span>
</p>
<p class="mb-none">
	<span class="text-dark">Payment Date:</span>
	<span class="value">$payment_time</span>
</p>
$payment_due_data
EOD;

}else{
$payment_status_data .= <<<EOD
<p class="mb-none">
	<span class="text-dark">Payment:</span>
	<span class="value"><span class="label label-danger">Pending</span></span>
</p>
EOD;
}




//Product Item Details List
$list = '';

$query = $db->query("SELECT * FROM `item` WHERE `status` = 1 ");
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
						<div class="panel-body">
							<div class="invoice">
								<header class="clearfix">
									<div class="row" style="margin-bottom: 20px;">
										<div class="col-sm-6 mt-md">
											<h2 class="h2 mt-none mb-sm text-dark text-weight-bold">JOB ID</h2>
											<h4 class="h4 m-none text-dark text-weight-bold">#<?php echo $job_id_txt; ?></h4>
											<p><?php echo $sql; ?></p>
										</div>
										<div class="col-sm-6 text-right mt-md mb-md">
											<h4 class="h4 m-none text-dark text-weight-bold"><span class="label <?php echo $status_lbl_class; ?>"><?php echo $status_lbl; ?></span></h4>
											<h4 class="h4 m-none text-dark text-weight-bold" style="padding-top: 15px;"><span class="label <?php echo $progress_lbl_class; ?>"><?php echo $progress_lbl; ?></span></h4>
											
										</div>
									</div>
								</header>
								<div class="bill-info">
									<div class="row">
										<div class="col-md-4">
											<div class="bill-to">
												<p class="h5 mb-xs text-dark text-weight-semibold">CLIENT:</p>
												<?php echo $client_details; ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="bill-to">
												<p class="h5 mb-xs text-dark text-weight-semibold">TECHNICIAN:</p>
												<?php echo $technician_details; ?>
											</div>
										</div>
										<div class="col-md-4">
											<div class="bill-data text-right">
												<p class="mb-none">
													<span class="text-dark">Order Date:</span>
													<span class="value"><?php echo $add_time; ?></span>
												</p>
												<?php echo $status_data; ?>
												<?php echo $complete_status_data; ?>
												<?php echo $delivery_status_data; ?>
												<?php echo $recieved_status_data; ?>
												<?php echo $payment_status_data; ?>
											</div>
										</div>
									</div>
								</div>
							
								<div class="table-responsive">
									<table class="table invoice-items">
										<thead>
											<tr class="h4 text-dark">
												<th id="cell-item"   class="text-weight-semibold">Item</th>
												<th id="cell-price"  class="text-center text-weight-semibold">Price</th>
												<th id="cell-qty"    class="text-center text-weight-semibold">Qty</th>
												<th id="cell-total"  class="text-center text-weight-semibold">Total</th>
											</tr>
										</thead>
									</table>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="toggle" data-plugin-toggle>
											<?php echo $item_list; ?>
										</div>
									</div>
								</div>
							
								<div class="invoice-summary">
									<div class="row">
										<div class="col-sm-4 col-sm-offset-8">
											<table class="table h5 text-dark">
												<tbody>
													<tr class="b-top-none">
														<td colspan="2">Subtotal</td>
														<td class="text-right"><?php echo $tmp_amount_sub_tot_txt; ?></td>
													</tr>
													<?php echo $tech_cost_data; ?>
													<?php echo $travel_cost_data; ?>
													<?php echo $other_cost_data; ?>
													<?php echo $delivery_cost_data; ?>
													<tr class="h4">
														<td colspan="2">Grand Total</td>
														<td class="text-right"><?php echo $tmp_amount_tot_txt; ?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="text-right mr-lg">
								<?php echo $manage_btn; ?>
							</div>
						</div>
					</section>
					<!-- end: page -->
				</section>
			</div>
		</section>

		<?php include 'include/footer.php'; ?>

	</body>
</html>