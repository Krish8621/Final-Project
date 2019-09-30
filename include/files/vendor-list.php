<?php

$web_user_id            = $_COOKIE['web_user_id'];

$vendor_cookie 			= $_COOKIE['vendor'];
$sub_category_cookie 	= $_COOKIE['sub_category'];
$city_cookie 			= $_COOKIE['city'];
$district_cookie 		= $_COOKIE['district'];
$province_cookie 		= $_COOKIE['province'];


$sql = 'SELECT * FROM `user` WHERE `status` = 1 AND `level_id` = 2';

if ( isset( $city_cookie ) ) {
    $sql .= ' AND `city_id` = '.$city_cookie;
}

if ( isset( $district_cookie ) ) {
    $sql .= ' AND `district_id` = '.$district_cookie;
}

if ( isset( $province_cookie ) ) {
    $sql .= ' AND `province_id` = '.$province_cookie;
}



$sql .= ' ORDER BY `id` DESC';

$list = '';

$query = $db->query($sql);
$rowCount = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

    	$id                = $row['id'];
    	$name              = strtoupper($row['name']);
    	$address           = $row['address'];
    	$vendor_province   = $row['province_id'];
        $district_id       = $row['district_id'];
        $city_id           = $row['city_id'];


        $query_district  = $db->query("SELECT * FROM `location` WHERE `id` = '$district_id' ");
        $row_district    = $query_district->fetch_assoc();
        $vendor_district = $row_district['name'];

        $query_city  = $db->query("SELECT * FROM `location` WHERE `id` = '$city_id' ");
        $row_city    = $query_city->fetch_assoc();
        $vendor_city = $row_city['name'];



$list .= <<<DATA
<div class="item list-group-item " style="">
  <div class="img-ser"> 
    <!-- Item Details -->
    <div class="cap-text">
    	<div class="item-name-new">
    		<div class="col-md-12" style="overflow: hidden;float:left;padding-left: 0;width:410px;">
    			<a href="./" data-id="$id" class="i-tittle set-vendor">$name </a> 
    		</div>
  			
      		<span class="price">$address </span> 
      		<span class="price">$vendor_city - $vendor_district </span>
        	<!-- Details -->
      </div>
    </div>
  </div>
</div>
DATA;
    }
}


echo $list;



?>