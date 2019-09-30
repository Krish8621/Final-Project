<?php

require 'config.php';

$get_id = $_GET['id'];

$query = $db->query("SELECT * FROM `job` WHERE `id` = '$get_id'");
$row = $query->fetch_assoc();

$id = $row['id'];
$approve_status = $row['approve_status'];
$complete_status = $row['complete_status'];
$delivery_av = $row['delivery'];
$payment_status = $row['payment'];
$delivered_status = $row['delivered'];

$delivery_amount = $row['delivery_amount'];
$travelling_amount = $row['travelling_amount'];
$other_amount = $row['other_amount'];


$job_id_txt = str_pad($id,10,0,STR_PAD_LEFT);

$approve_status_data = '';

if ( $approve_status == 0 ) {

	if ( $approve_status == 0 ) {
		$st_0 = 'selected';
	}elseif ( $approve_status == 1 ) {
		$st_1 = 'selected' ;
	}elseif ( $approve_status == 2 ) {
		$st_2 = 'selected' ;
	}


	$approve_status_list = '<option value="0" '.$st_0.'>Pending</option>
	<option value="1" '.$st_1.'>Approve</option>
<option value="2" '.$st_2.'>Decline</option>';

$approve_status_data .= <<<EOD
<div class="form-group">
	<label class="col-md-6 control-label" for="status">Approval</label>
	<div class="col-md-6">
		<select style="width: 100%;" name="approve">
			$approve_status_list
		</select>
	</div>
</div>
EOD;
}

$complete_status_data = '';

if ( $complete_status == 0 ) {

	if ( $complete_status == 0 ) {
		$st_1 = 'selected';
	}elseif ( $complete_status == 1 ) {
		$st_2 = 'selected' ;
	}

	$job_done_list = '<option value="0" '.$st_1.'>Ongoing</option>
<option value="1" '.$st_2.'>Completed</option>';

$complete_status_data .= <<<EOD
<div class="form-group">
	<label class="col-md-6 control-label" for="status">Progress</label>
	<div class="col-md-6">
		<select style="width: 100%;" name="progress">
			$job_done_list
		</select>
	</div>
</div>
EOD;
}


$delivery_data = '';

if ( $delivery_av == 1 ) {	

	$delivery_s_data = '';
	
	if ( $delivered_status == 0 ) {

		if ( $delivered_status == 0 ) {
			$st_1 = 'selected';
		}elseif ( $delivered_status == 1 ) {
			$st_2 = 'selected' ;
		}

		$delivered_list = '<option value="0" '.$st_1.'>Not yet</option>
	<option value="1" '.$st_2.'>Delevered</option>';

$delivery_s_data .= <<<EOD
<div class="form-group">
	<label class="col-md-6 control-label" for="status">Delivered</label>
	<div class="col-md-6">
		<select style="width: 100%;" name="delivery_status">
			$delivered_list
		</select>
	</div>
</div>
EOD;
	}

$delivery_data .= <<<EOD
$delivery_s_data
<div class="form-group">
	<label class="col-md-6 control-label" for="level">Delivery Cost</label>
	<div class="col-md-6">
		<input type="text" name="delivery_cost" class="form-control" value="$delivery_amount">
	</div>
</div>
EOD;
}

$payment_recieved_list = '';
if ( $payment_status == 0 ) {

	if ( $payment_status == 0 ) {
			$st_1 = 'selected';
		}elseif ( $payment_status == 1 ) {
			$st_2 = 'selected' ;
		}

$payment_recieved_list .= <<<EOD
<div class="form-group">
	<label class="col-md-6 control-label" for="status">Payment </label>
	<div class="col-md-6">
		<select style="width: 100%;" name="payment_status">
			<option value="0" $st_1>Pending</option>
			<option value="1" $st_2>Recieved</option>
		</select>
	</div>
</div>
EOD;
}



?>



<div id="custom-content" class="modal-block modal-block-md">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title">MANAGE JOB #<?php echo $job_id_txt; ?> </h2>
		</header>
		<form method="POST">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						
						<?php echo $approve_status_data; ?>
						<?php echo $complete_status_data; ?>
						<?php echo $payment_recieved_list; ?>
						<?php echo $delivery_data; ?>
						
						<div class="form-group">
							<label class="col-md-6 control-label" for="level">Travelling Cost</label>
							<div class="col-md-6">
								<input type="text" name="travel_cost" class="form-control" value="<?php echo $travelling_amount; ?>">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-6 control-label" for="level">Other Expenses</label>
							<div class="col-md-6">
								<input type="text" name="other_expenses" class="form-control" value="<?php echo $other_amount; ?>">
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="panel-footer">
				<div class="row">
					<div class="col-md-12 text-right">
						<input type="text"name="tmp_id" value="<?php echo $get_id; ?>" style="display: none;" >
						<button type="submit" name="save" class="btn btn-primary ">Save</button>
						<button class="btn btn-default modal-dismiss">Close</button>
					</div>
				</div>
			</footer>
		</form>			
	</section>
</div>

