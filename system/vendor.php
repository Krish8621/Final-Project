<?php

require 'config.php';

//Page Title
$page = 'VENDORS';


//Page Access 

/*
$level = 1 //Admin Controls
$level = 2 //Vendor Controls
*/

$level = 1;


//Vendor List
$list = '';

$query = $db->query("SELECT * FROM `user` WHERE `status` = 1 AND  `level_id` = 2 ORDER BY `name` ASC ");
$rowCount = $query->num_rows;
if($rowCount > 0){
	$nos = 0;
    while($row = $query->fetch_assoc()){

    	$nos++;

    	$id = $row['id'];
    	$name = $row['name'];
    	$province_id = $row['province_id'];
    	$district_id = $row['district_id'];
    	$city_id = $row['city_id'];

    	//Vendor Province
    	$query_p = $db->query("SELECT * FROM `location` WHERE `id` = '$province_id' ");
    	$row_p = $query_p->fetch_assoc();
    	$name_p = $row_p['name'];

    	//Vendor District
    	$query_d = $db->query("SELECT * FROM `location` WHERE `id` = '$district_id' ");
    	$row_d = $query_d->fetch_assoc();
    	$name_d = $row_d['name'];

    	//Vendor City
    	$query_c = $db->query("SELECT * FROM `location` WHERE `id` = '$city_id' ");
    	$row_c = $query_c->fetch_assoc();
    	$name_c = $row_c['name'];

$list .= <<<DATA
<tr>
	<td class="text-center">$nos</td>
	<td>$name</td>
	<td class="text-center">$name_c</td>
	<td class="text-center">$name_d</td>	
	<td class="text-center">$name_p</td>
	<td class="actions text-center">
		<a href="#" class="on-default cancel-row"><i class="fa fa-search"></i></a>
		<a href="#" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
		<a href="vendor?delete=$id" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
	</td>
</tr>
DATA;
    }
}


if (isset($_GET['delete'])) {

	$del_id 	= $_GET['delete'];
	$del_table 	= "vendor";
	
	delete($del_id, $del_table);

	header('location:vendor');

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
					
							<h2 class="panel-title">VENDORS</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none" id="datatable-default">
								<thead>
									<tr>
										<th class="text-center" style="width: 5%;">#</th>
										<th class="text-center" style="width: 25%;">Name</th>
										<th class="text-center" style="width: 20%;">City</th>
										<th class="text-center" style="width: 20%;">District</th>
										<th class="text-center" style="width: 20%;">Province</th>
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