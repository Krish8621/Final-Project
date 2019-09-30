<?php

require 'config.php';

//Page Title
$page = 'JOBS';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$user_id = $_COOKIE['user_id'];
$get_level = $_COOKIE['user_level'];




if ( $get_level == 1 ) {
    $sql = "SELECT * FROM `job` ORDER BY `id` DESC ";
}else{
    $sql = "SELECT * FROM `job` WHERE `tech_id` = '$user_id' ORDER BY `id` DESC ";
}


//Product Item Details List
$list = '';

$query = $db->query($sql);
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id                    = $row['id'];
    	$client_id             = $row['client_id'];
    	$approve_status        = $row['approve_status'];
        $complete_status       = $row['complete_status'];
        $delivery              = $row['delivery'];
        $delivered             = $row['delivered'];


        $query_client = $db->query("SELECT * FROM `user` WHERE `id` = '$client_id' ");
        $row_client = $query_client->fetch_assoc();
        $client_name = $row_client['name'];

        $tmp_amount = 0;
        $query_amount = $db->query("SELECT * FROM `sale_assemble` WHERE `job_id` = '$id' ");
        $rowCount_amount = $query_amount->num_rows;
        if($rowCount_amount > 0){
            
            while($row_amount = $query_amount->fetch_assoc()){
                $tmp_amount += $row_amount['item_purchase_amount'];
            }
        }


        $job_amount = number_format($tmp_amount, 2, '.', ',');

    	$nos_new = str_pad($id,10,0,STR_PAD_LEFT);

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



$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td class="text-center"><b>#$nos_new</b></td>
	<td>$client_name</td>
    <td class="text-right">$job_amount</td>
    <td class="text-center"><span class="label $status_lbl_class">$status_lbl</span></td>
	<td class="text-center"><span class="label $progress_lbl_class">$progress_lbl</span></td>
	<td class="actions text-center">
		<a href="order-view?order_id=$id" class="on-default cancel-row"><i class="fa fa-search"></i></a>
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
					
							<h2 class="panel-title">JOB LIST</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 15%;">Job ID</th>
										<th class="text-center" style="width: 25%;">Client</th>
                                        <th class="text-center" style="width: 15%;">Job Amount</th>
										<th class="text-center" style="width: 15%;">Status</th>
                                        <th class="text-center" style="width: 15%;">Progress</th>
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