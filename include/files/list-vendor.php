<?php

$vendor 				= $_COOKIE['vendor'];
$city 					= $_COOKIE['city'];
$district 				= $_COOKIE['district'];
$province 				= $_COOKIE['province'];

$sub_category_cookie 	= $_COOKIE['sub_category'];

$list 			= '';

$vid = 1;

$sql = 'SELECT * FROM `user` WHERE `status` = 1 AND `level_id` = 2';

if ( isset( $city ) ) {
    $sql .= ' AND `city_id` = '.$city;
}

if ( isset( $district ) ) {
    $sql .= ' AND `district_id` = '.$district;
}

if ( isset( $province ) ) {
    $sql .= ' AND `province_id` = '.$province;
}

$sql .= ' LIMIT 20';


$query = $db->query($sql);
$rowCount = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

    	//`id`, `name`, `contact`, `email`, `location_province_id`, `location_district_id`, `location_city_id`, `status`

    	$id = $row['id'];
    	$name = $row['name'];

    	if ( $id == $vendor ) {

    		$select = 'select';

    		$close = '<i class="fa fa-close vendor-clear vendor-clear-style"></i>';
    	}else{
    		$select = '';
    		$close = '';
    	}

$list .=<<<EOD
<li ><a href="javascript:void(0);" class="set-vendor $select" data-id="$id">$name<span>$rowCount_sub</span></a>$close</li>
EOD;


	    }
	}

$all = <<<ALL
<h5 class="shop-tittle margin-top-60 margin-bottom-30">Vendors</h5>
<ul class="shop-cate">
	$list
</ul>
ALL;

echo $all;

?>