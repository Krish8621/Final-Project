<?php
/*
$user_type = 1		Admin Users
$user_type = 2		Vendors
$user_type = 3		Technicians
*/

$user_id = $_COOKIE['user_id'];
$user_type = $_COOKIE['user_level'];

$query_job_count = $db->query("SELECT * FROM `job` WHERE `tech_id` = '$user_id' AND `approve_status` = 0 ");
$jobCount = $query_job_count->num_rows;

if ( $jobCount > 0 ) {
	$jobCount = '<span class="pull-right label label-primary">'.$jobCount.'</span>';
}else{
	$jobCount = '';
}




$sidebar_item = '';
$sidebar_all = '';
$sidebar_product = '';
$sidebar_jobs = '';

$sidebar_other = '';

if ( $user_type == 1 ) {

$sidebar_item = <<<EOD
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Items</span>
	</a>
	<ul class="nav nav-children">
		<li>
			<a href="item">Items List</a>
		</li>
		<li>
			<a href="item-add">Add New Item</a>
		</li>
	</ul>
</li>
EOD;

$sidebar_all = <<<EOD
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Vendors</span>
	</a>
	<ul class="nav nav-children">
		<li>
			<a href="vendor">Vendor List</a>
		</li>
		<li>
			<a href="vendor-add">Add New Vendor</a>
		</li>
	</ul>
</li>
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Technicians</span>
	</a>
	<ul class="nav nav-children">
		<li>
			<a href="technicians">Technicians List</a>
		</li>
	</ul>
</li>
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Users</span>
	</a>
	<ul class="nav nav-children">
		<li>
			<a href="users">Users List</a>
		</li>
	</ul>
</li>
EOD;

$sidebar_jobs .= <<<EOD
<li>
	<a href="order">			
		<i class="fa fa-bell" aria-hidden="true"></i>
		<span>JOBS</span>
	</a>
</li>
EOD;

$sidebar_product = <<<EOD
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Product</span>
	</a>
	<ul class="nav nav-children">
		<li class="nav-parent">
			<a>Product Item Details</a>
			<ul class="nav nav-children">
				<li>
					<a href="product-item">Product Items Details</a>
				</li>
				<li>
					<a href="product-item-add">Add New Product Item Detail</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="product-brand">Product Brand</a>
		</li>
		<li>
			<a href="product-category">Product Category</a>
		</li>
		<li>
			<a href="product-category-sub">Product Sub Category</a>
		</li>
		<li>
			<a href="product-label">Product Item Labels</a>
		</li>
	</ul>
</li>
EOD;

$sidebar_other = <<<EOD
<nav id="menu" class="nav-main" role="navigation">
	<ul class="nav nav-main">
		<li class="nav-parent">
			<a>
				<i class="fa fa-align-left" aria-hidden="true"></i>
				<span>Other</span>
			</a>
			<ul class="nav nav-children">
				<li class="nav-parent">
					<a>Area Manager</a>
					<ul class="nav nav-children">
						<li>
							<a href="area-city">Cities</a>
						</li>
						<li>
							<a href="area-district">District</a>
						</li>
						<li>
							<a href="area-province">Province</a>
						</li>
					</ul>
				</li>
			</ul>
		</li>
	</ul>
</nav>
EOD;
	
}elseif ( $user_type == 2 ) {

$sidebar_item = <<<EOD
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Items</span>
	</a>
	<ul class="nav nav-children">
		<li>
			<a href="item">Items List</a>
		</li>
		<li>
			<a href="item-add">Add New Item</a>
		</li>
	</ul>
</li>
EOD;

$sidebar_product = <<<EOD
<li class="nav-parent">
	<a>
		<i class="fa fa-align-left" aria-hidden="true"></i>
		<span>Product</span>
	</a>
	<ul class="nav nav-children">
		<li class="nav-parent">
			<a>Product Item Details</a>
			<ul class="nav nav-children">
				<li>
					<a href="product-item">Product Items Details</a>
				</li>
				<li>
					<a href="product-item-add">Add New Product Item Detail</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="product-brand">Product Brand</a>
		</li>
		<li>
			<a href="product-category">Product Category</a>
		</li>
		<li>
			<a href="product-category-sub">Product Sub Category</a>
		</li>
		<li>
			<a href="product-label">Product Item Labels</a>
		</li>
	</ul>
</li>
EOD;
}elseif ( $user_type == 3 ) {

$sidebar_jobs .= <<<EOD
<li>
	<a href="order">
		$jobCount				
		<i class="fa fa-bell" aria-hidden="true"></i>
		<span>JOBS</span>
	</a>
</li>
EOD;
}

?>


<aside id="sidebar-left" class="sidebar-left">
	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<?php echo $sidebar_item; ?>
					<?php echo $sidebar_jobs; ?>
					<?php echo $sidebar_all; ?>
					<?php echo $sidebar_product; ?>
					
				</ul>
			</nav>

			<hr class="separator" />

			<?php echo $sidebar_other; ?>
		</div>

	</div>

</aside>