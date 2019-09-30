<?php
include 'config.php';

if ( isset($_POST['type']) && $_POST['type'] == 'get_tech_data' ) {

	$get_id = $_POST['id'];

	$get_province = $_POST['list_province'];
	$get_district = $_POST['list_district'];
	$get_city = $_POST['list_city'];

	$list = '';

	$sql = "SELECT * FROM `user` WHERE `level_id` = 3 AND `status` = 1 ";

	if ( isset($get_province) ) {
		$sql .= "AND `province_id` = '$get_id' ";
	}

	if ( isset($get_district) ) {
		$sql .= "AND `district_id` = '$get_id' ";
	}

	if ( isset($get_city) ) {
		$sql .= "AND `city_id` = '$get_id' ";
	}


	$query = $db->query($sql);
	$rowCount = $query->num_rows;
	if($rowCount > 0){      
		$tmp_item_amount = 0;
		while($row = $query->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];

$list .= <<<EOD
<option value="$id">$name</option>
EOD;
		}
	}

$data =<<<EOD
<div class="form-group">
	<label> TECHNICIAN</label>
	<select class="form-control cal-total" name="technician" id="get-tech-details">
		<option>SELECT</option>
		$list
	</select>
</div>
<div id="tech-details">
</div> 
EOD;

echo $data;
}


if ( isset($_POST['type']) && $_POST['type'] == 'get_tech_details' ) {

	$get_id = $_POST['id'];

	$query = $db->query("SELECT * FROM `user` WHERE `id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){      
		$tmp_item_amount = 0;
		while($row = $query->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];
			$contact = $row['contact'];
			$email = $row['username'];
			$travel_cost_av = $row['travel_cost_av'];
			$rate_hour = $row['hour_rate'];
			$rate_assemble = $row['assemble_rate'];

			if ( $travel_cost_av == 1 ) {
				$tavel_av = '+ Travelling cost';
			}else{
				$tavel_av = '';
			}


			$rate_hour = number_format($rate_hour, 2, '.', ',');
			$rate_assemble = number_format($rate_assemble, 2, '.', ',');
		}
	}

$data =<<<EOD
<table style="width: 100%;">
	<tr>
		<td style="width: 40%;padding: 10px 0;">Name</td>
		<td style="width: 60%;padding: 10px 0;">$name</td>
	</tr>
	<tr>
		<td style="width: 40%;padding: 10px 0;">Contact Number</td>
		<td style="width: 60%;padding: 10px 0;">$contact</td>
	</tr>
	<tr>
		<td style="width: 40%;padding: 10px 0;">Email</td>
		<td style="width: 60%;padding: 10px 0;">$email</td>
	</tr>
	<tr>
		<td style="width: 40%;padding: 10px 0;">Rate (per Hour)</td>
		<td style="width: 60%;padding: 10px 0;">$rate_hour</td>
	</tr>
	<tr>
		<td style="width: 40%;padding: 10px 0;">Assemble Rate</td>
		<td style="width: 60%;padding: 10px 0;">$rate_assemble $tavel_av</td>
	</tr>
</table>
EOD;

echo $data;
}


if ( isset($_POST['type']) && $_POST['type'] == 'get_tech_data_district' ) {

	$get_id = $_POST['id'];

	$list = '';

	$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = '$get_id' AND `status` = 1 ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){      
		$tmp_item_amount = 0;
		while($row = $query->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];

$list .= <<<EOD
<option value="$id">$name</option>
EOD;
		}
	}

$data =<<<EOD
<div class="form-group">
	<label> TECHNICIAN DISTRICT</label>
	<select class="form-control cal-total" id="tech-district-select">
		<option>SELECT</option>
		$list
	</select>
</div>
EOD;

echo $data;
}

if ( isset($_POST['type']) && $_POST['type'] == 'get_tech_data_city' ) {

	$get_id = $_POST['id'];

	$list = '';

	$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = '$get_id' AND `status` = 1 ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){      
		$tmp_item_amount = 0;
		while($row = $query->fetch_assoc()){
			$id = $row['id'];
			$name = $row['name'];

$list .= <<<EOD
<option value="$id">$name</option>
EOD;
		}
	}

$data =<<<EOD
<div class="form-group">
	<label> TECHNICIAN CITY</label>
	<select class="form-control cal-total" id="tech-city-select">
		<option>SELECT</option>
		$list
	</select>
</div>
EOD;

echo $data;
}



if ( isset($_POST['type']) && $_POST['type'] == 'get_cost_details' ) {

	$user_id = $_COOKIE['web_user_id'];

	$get_tech = $_POST['tech_id'];

	$list = '';

	$query = $db->query("SELECT * FROM `sale_assemble` WHERE `status` = 0 AND `user_id` = '$user_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	  	$amount_sub_tot = 0;
	  	while($row = $query->fetch_assoc()){

		    $id = $row['id'];
		    $user_id = $row['user_id'];
		    $item_id = $row['item_id'];

		    $query_item = $db->query("SELECT * FROM `item` WHERE `id` = '$item_id' ");
		    $row_item = $query_item->fetch_assoc();
		    $vendor_id = $row_item['vendor_id'];
		    $product_item_id = $row_item['item_id'];
		    $product_category_id = $row_item['category_id'];
		    $amount = $row_item['amount'];

		    $query_cat = $db->query("SELECT * FROM `product_category` WHERE `id` = '$product_category_id' ");
		    $row_cat = $query_cat->fetch_assoc();
		    $rowCount_cat = $query_cat->num_rows;
		    $category = $row_cat['type'];

		    $amount_sub_tot += $amount;

		    $amount_label = number_format($amount, 2, '.', ',');

	    	
$list .= <<<EOD
<p>$category <span>$amount_label </span></p>
EOD;
	    }
	}

	if (isset($get_tech)) {

		$query_tech = $db->query("SELECT * FROM `user` WHERE `id` = '$get_tech' ");
	    $row_tech = $query_tech->fetch_assoc();
	    $hour_rate = $row_tech['hour_rate'];
	    $assemble_rate = $row_tech['assemble_rate'];

	    if ( $_COOKIE['service_type'] == 'service_assemble' ) {

	    	$tec_rate = $assemble_rate;

	    }elseif ( $_COOKIE['service_type'] == 'service_part' ) {

	    	$tec_rate = $hour_rate;
	    	
	    }elseif ( $_COOKIE['service_type'] == 'service_service' ) {

	    	$tec_rate = $hour_rate;
	    	
	    }
		
	}else{
		$tec_rate = 0;
	}

	

	$amount_sub_tot_label = number_format($amount_sub_tot, 2, '.', ',');

	$tec_rate_label = number_format($tec_rate, 2, '.', ',');

	$amount_tot = $amount_sub_tot + $tec_rate;

	$amount_tot_label = number_format($amount_tot, 2, '.', ',');


$data =<<<EOD
<h6>Your Order</h6>
<div class="order-place">
	<div class="order-detail">
	<p style="font-weight: bold;border-bottom: navajowhite;margin-bottom: 10px;">ITEM <span>AMOUNT </span></p>
	$list                    
	<!-- SUB TOTAL -->
	<p class="all-total">SUB TOTAL <span> $amount_sub_tot_label</span></p>
	<p>TECHNICIAN <span>$tec_rate_label</span></p> 
	<p class="all-total">TOTAL COST<span> $amount_tot_label</span></p>
	</div>                  
	<form method="POST">
		<div class="checkbox ">                          
			<input id="checkbox3-1" class="styled pointer" name="delivery" type="checkbox" value="1">
			<label for="checkbox3-1" class="pointer"><span class="color"> DELIVERY? </span> </label>
		</div>
		<p style="font-size: 12px;line-height: 18px;font-weight: 200;">Delivery cost may depend with your delivery location and the delivery service provider. It will be add by the Technician after the job done.</p>
		<div class="pay-meth">
			<ul>
				<li>
					<div class="radio">
						<input class="pointer" type="radio" name="payment_method" id="radio1" value="1" checked>
						<label class="pointer" for="radio1"> DIRECT BANK TRANSFER </label>
					</div>                        
				</li>
				<li>
					<div class="radio">
						<input class="pointer" type="radio" name="payment_method" id="radio2" value="2">
						<label class="pointer" for="radio2"> CASH ON DELIVERY</label>
					</div>
				</li>
				<li>
					<div class="radio">
						<input class="pointer" type="radio" name="payment_method" id="radio3" value="3">
						<label class="pointer" for="radio3"> CREDIT CARD PAYMENT </label>
					</div>
				</li>
				<li>
					<div class="radio">
						<input class="pointer" type="radio" name="payment_method" id="radio4" value="4">
						<label class="pointer" for="radio4"> CHEQUE PAYMENT </label>
					</div>
				</li>
				<li>
					<label style="margin: 40px 0 10px 0;font-weight: 600;">*TERMS & CONDITIONS</label>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam erat turpis, pellentesque non leo eget, pulvinar pretium arcu. Mauris porta elit non.</p>
					<div class="checkbox">                          
						<input id="proceed-accept" class="styled pointer" type="checkbox" required="">
						<label class="pointer" for="proceed-accept"> I’VE READ AND ACCEPT THE <span class="color"> TERMS & CONDITIONS </span> </label>
					</div>
				</li>
			</ul>
			<button type="submit" id="proceed" class="btn btn-dark pull-right margin-top-30" name="proceed">PROCEED</button>
		</div>
	</form>                    
</div>
EOD;

echo $data;
}


?>
