<?php
include 'config.php';

if ( isset($_POST['type']) && $_POST['type'] == 'get_order_data' ) {

	$get_id = $_POST['job_id'];

	$query = $db->query("SELECT * FROM `job` WHERE `id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
		while($row = $query->fetch_assoc()){

    		$id 					= $row['id'];
    		$job_id                 = $id;
    		$tech_id				= $row['tech_id'];

    		$add_time 				= date('j<\s\up>S<\/\s\up> M, Y H:i A' , strtotime($row['add_time']) );

    		$approve_status 		= $row['approve_status'];
    		$approve_time	 		= $row['approve_time'];

    		$complete_status 		= $row['complete_status'];
    		$complete_time	 		= $row['complete_time'];

    		$delivery_available 	= $row['delivery'];
    		$delivered_status 		= $row['delivered'];
    		$delivered_time	 		= $row['delivered_time'];

    		$recieved_status 		= $row['recieved'];
    		$recieved_time	 		= $row['recieved_time'];

    		$review					= $row['review'];

			$id_data = str_pad( $id, 10, 0 , STR_PAD_LEFT);


			$job_cost 				= $row['job_amount'];			
			$other_amount			= $row['other_amount'];
			$travelling_amount		= $row['travelling_amount'];
			$delivery_amount 		= $row['delivery_amount'];

			$sub_tot 				= $job_cost + $other_amount + $travelling_amount;
			$total 					= $sub_tot + $delivery_amount;

			$job_cost_txt			= number_format( $job_cost ,2,'.',',' );
			$other_cost_txt			= number_format( $other_amount ,2,'.',',' );
			$travel_cost_txt		= number_format( $travelling_amount ,2,'.',',' );
			$delivery_cost_txt		= number_format( $delivery_amount ,2,'.',',' );
			$sub_tot_txt			= number_format( $sub_tot ,2,'.',',' );
			$total_txt				= number_format( $total ,2,'.',',' );


			$payment_method_id 		= $row['payment_method_id'];
    		$payment 				= $row['payment'];
    		$payment_time	 		= $row['payment_time'];

    		$query_pay = $db->query("SELECT * FROM `payment_method` WHERE `id` = '$payment_method_id' ");
    		$row_pay = $query_pay->fetch_assoc();
    		$payment_method = $row_pay['type'];

    		if ( $payment == 1 ) {
    			$payment_label = 'Paid';
    			$payment_time	= date('j<\s\up>S<\/\s\up> M, Y H:i A' , strtotime($payment_time) );
    		}else{
    			$payment_label = 'Unpaid';
    			$payment_time = '-';
    		}


    		$query_tech = $db->query("SELECT * FROM `user` WHERE `id` = '$tech_id' ");
    		$row_tech = $query_tech->fetch_assoc();
    		$tech_email = $row_tech['username'];
    		$tech_name = $row_tech['name'];
    		$tech_contact = $row_tech['contact'];
		}
	}



	 if ( $approve_status == 1 ) {
	 	$approve = '<span class="compatible">Approved</span>';
	 	$approve_time = date('j<\s\up>S<\/\s\up> M, Y H:i A' , strtotime($approve_time) );
	 }else{
	 	$approve = '<span class="not-compatible">Pending</span>';
	 	$approve_time = '';
	 }


	 if ( $complete_status == 1 ) {
	 	$complete = '<span class="compatible">Completed</span>';
	 	$complete_time = date('j<\s\up>S<\/\s\up> M, Y H:i A' , strtotime($complete_time) );
	 }else{
	 	$complete = '<span class="not-compatible">Pending</span>';
	 	$complete_time = '';
	 }


	 if ( $recieved_status == 1 ) {
	 	$recieved = '<span class="compatible">Recieved</span>';
	 	$recieved_time = date('j<\s\up>S<\/\s\up> M, Y H:i A' , strtotime($recieved_time) );
	 }else{
	 	$recieved = '<span class="not-compatible">Pending</span>';
	 	$recieved_time = '';	 	
	 }


	 $recieved_btn = '';

	 if ( $delivery_available == 1 ) {
	 	
	 	if ( $delivered_status == 1 && $complete_status == 1 ) {
	 		
	 		$recieved_btn = '<form method="POST">
					<input type="text" name="tmp_job_id" value="'.$job_id.'" style="display: none;">
					<button type="submit" class="btn" name="recieved">RECIEVED</button>
				</form>';

	 	}
	 }else {
	 	if ( $complete_status == 1 ) {
	 		
	 		$recieved_btn = '<form method="POST">
					<input type="text" name="tmp_job_id" value="'.$job_id.'" style="display: none;">
					<button type="submit" class="btn" name="recieved">RECIEVED</button>
				</form>';

	 	}
	 }

	 if ( $recieved_status != 0 ) {
	 	$recieved_btn = '';
	 }


$delivered = '';

	 if ( $delivery_available == 1 ) {

	 	if ( $delivered_status == 1 ) {
	 		$delivered_data = '<span class="compatible">Delivered</span>';
	 		$delivered_time = date('j<\s\up>S<\/\s\up> M, Y H:i A' , strtotime($delivered_time) );
	 	}else{	 		
	 		$delivered_data = '<span class="not-compatible">Pending</span>';
	 		$delivered_time = '';
	 	}	 	

$delivered .= <<<EOD
<tr>
	<td style="width: 35%;">Delivered</td>
	<td style="width: 30%; text-align: center;">$delivered_data</td>
	<td style="width: 35%; text-align: right;">$delivered_time</td>
</tr>
EOD;

	 }else{ 

	$delivered .= '';

	 }


}

$tech_data = '';
$tech_feedback = '';

if ( $tech_id > 0 ) {
$tech_data .= <<<EOD
<div class="order-detail">
	<p style="font-weight: bold;border-bottom: navajowhite;margin-bottom: 10px;">Technician Details </p>
	<p>Name <span>$tech_name</span></p>                    
	<p>Contact<span>$tech_contact</span></p>   
	<p>email <span>$tech_email</span></p> 
</div>
EOD;

	if ( $review == 0 && $recieved_status == 1 ) {

$tech_feedback .= <<<EOD
<form method="POST">
	<div class="pay-meth">
		<div class="form-group">
			<label for="feedback" style="font-size: 14px;display: inherit;">Rate</label>
			<fieldset class="rating">
				<input type="radio" id="star10" name="rating" value="10" />
				<label class = "full" for="star10" title="10 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star9" name="rating" value="9" />
				<label class="full" for="star9" title="9 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star8" name="rating" value="8" />
				<label class = "full" for="star8" title="8 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star7" name="rating" value="7" checked />
				<label class="full" for="star7" title="7 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star6" name="rating" value="6" />
				<label class = "full" for="star6" title="6 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star5" name="rating" value="5" />
				<label class="full" for="star5" title="5 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star4" name="rating" value="4" />
				<label class = "full" for="star4" title="4 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star3" name="rating" value="3" />
				<label class="full" for="star3" title="3 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star2" name="rating" value="2" />
				<label class = "full" for="star2" title="2 Stars" style="font-size: 18px;"></label>
				<input type="radio" id="star1" name="rating" value="1" />
				<label class="full" for="star1" title="1 Stars" style="font-size: 18px;"></label>
			</fieldset>
		</div>                        

		<div class="form-group">
			<label for="feedback" style="font-size: 14px;">Fedback</label>
			<textarea id="feedback" class="form-control" rows="6"></textarea>
		</div>

		<button class="btn btn-dark pull-right margin-top-30" name="proceed">SUBMIT</button>
	</div>
</form> 
EOD;
	}


}


$item_list = '';

$query = $db->query("SELECT * FROM `sale_assemble` WHERE `job_id` = '$id' ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	while($row = $query->fetch_assoc()){

	$id = $row['id'];
	$item_id = $row['item_id'];

	$query_item = $db->query("SELECT * FROM `item` WHERE `id` = '$item_id' ");
    $row_item = $query_item->fetch_assoc();
    $vendor_id = $row_item['vendor_id'];
    $product_item_id = $row_item['item_id'];
    $product_category_id = $row_item['category_id'];
    $item_amount = number_format( $row_item['amount'] ,2,'.',',' );

    //Product Item
    $query_i = $db->query("SELECT * FROM `product_items` WHERE `id` = '$product_item_id' ");
    $row_i = $query_i->fetch_assoc();
    $item_title = $row_i['title'];
    $item_brand_id = $row_i['brand_id'];
    $item_category_id = $row_i['category_id'];
    $item_sub_category_id = $row_i['sub_category_id'];

    //Product Brand
    $query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$item_brand_id' ");
    $row_b = $query_b->fetch_assoc();
    $brand_name = $row_b['title'];


    $label_1 = $row_item['label_1'];
    $label_2 = $row_item['label_2'];
    $label_3 = $row_item['label_3'];
    $label_4 = $row_item['label_4'];
    $label_5 = $row_item['label_5'];    

    //Label Type

    $query_label_1        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_1' ");
    $row_label_1        = $query_label_1->fetch_assoc();
    $label_l_1_label_id     = $row_label_1['product_label_id'];
    $label_l_1          = $row_label_1['type'];

    $query_label_2        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_2' ");
    $row_label_2        = $query_label_2->fetch_assoc();
    $label_l_2_label_id     = $row_label_2['product_label_id'];
    $label_l_2          = $row_label_2['type'];

    $query_label_3        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_3' ");
    $row_label_3        = $query_label_3->fetch_assoc();
    $label_l_3_label_id     = $row_label_3['product_label_id'];
    $label_l_3          = $row_label_3['type'];

    $query_label_4        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_4' ");
    $row_label_4        = $query_label_4->fetch_assoc();
    $label_l_4_label_id     = $row_label_4['product_label_id'];
    $label_l_4          = $row_label_4['type'];

    $query_label_5        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_5' ");
    $row_label_5        = $query_label_5->fetch_assoc();
    $label_l_5_label_id     = $row_label_5['product_label_id'];
    $label_l_5          = $row_label_5['type'];

    $all_labels = $label_l_1 . $label_l_2_n . $label_l_3_n . $label_l_4_n . $label_l_5_n;

$item_list .= <<<EOD
<p>$item_title - $brand_name $all_labels <span>$item_amount</span></p>
EOD;

	}
}



?>


<div class="col-md-9 compatible-data" style="margin: 0 auto;">
	<table style="margin: 0;">
		<tr>
			<th style="width: 35%;">Progress</th>
			<th style="width: 30%; text-align: center;">Status</th>
			<th style="width: 35%; text-align: center;">Date</th>
		</tr>
		<tr>
			<td style="width: 35%;">Purchase</td>
			<td style="width: 30%; text-align: center;"><b>#<?php echo $id_data; ?></b></td>
			<td style="width: 35%; text-align: right;"><?php echo $add_time; ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Approval</td>
			<td style="width: 30%; text-align: center;"><?php echo $approve; ?></td>
			<td style="width: 35%; text-align: right;"><?php echo $approve_time; ?></td>
		</tr>
		<tr>
			<td style="width: 35%;">Complete</td>
			<td style="width: 30%; text-align: center;"><?php echo $complete; ?></td>
			<td style="width: 35%; text-align: right;"><?php echo $complete_time; ?></td>
		</tr>
		<?php echo $delivered; ?>
		<tr>
			<td style="width: 35%;">Recieved</td>
			<td style="width: 30%; text-align: center;"><?php echo $recieved; ?></td>
			<td style="width: 35%; text-align: right;"><?php echo $recieved_time; ?><?php echo $recieved_btn; ?></div>
			</td>
		</tr>
	</table>
</div>
<div class="col-md-9 shopping-cart" style="margin: 40px auto 0;">
	<div class="order-place" style="">
		<div class="order-detail">
			<h5 style="color: #2d3a4b;text-align: center;">Purchased Items Details</h5>
			<hr>
			<p style="font-weight: bold;border-bottom: navajowhite;margin-bottom: 10px;">ITEM <span>AMOUNT </span></p>
			<?php echo $item_list; ?>              
		</div> 
		                   
	</div>
</div> 
<div class="col-md-9 shopping-cart" style="margin: 40px auto 0;">
	<div class="order-place" style="">
		<div class="order-detail">
			<h5 style="color: #2d3a4b;text-align: center;">Order Description</h5>
			<hr>
			<p style="font-weight: bold;border-bottom: navajowhite;margin-bottom: 10px;">Description <span>AMOUNT </span></p>
			<p>Job Cost <span><?php echo $job_cost_txt; ?> </span></p>                    
			<p>Travelling Cost <span><?php echo $travel_cost_txt; ?> </span></p>   
			<p>Other Expenses <span><?php echo $other_cost_txt; ?> </span></p>                 
			<!-- SUB TOTAL -->
			<p class="all-total">SUB TOTAL <span> <?php echo $sub_tot_txt; ?> </span></p>
			<p>Delivery  <span>Available </span></p>
			<p>Delivery Cost <span><?php echo $delivery_cost_txt; ?>  </span></p>
			<p class="all-total">TOTAL COST<span> <?php echo $total_txt; ?> </span></p>
		</div> 
		<div class="order-detail">
			<p>Payment Method <span><?php echo $payment_method; ?></span></p>                    
			<p>Payment <span><?php echo $payment_label; ?></span></p>   
			<p>Payment Date <span><?php echo $payment_time; ?></span></p> 
		</div>
		<?php echo $tech_data; ?>
		
		<?php echo $tech_feedback; ?>
		                   
	</div>
</div>  