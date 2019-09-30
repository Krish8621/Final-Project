<?php

$vendor 				= $_COOKIE['vendor'];
$city 					= $_COOKIE['city'];
$district 				= $_COOKIE['district'];
$province 				= $_COOKIE['province'];

$sub_category_cookie 	= $_COOKIE['sub_category'];

$list_acc = '';


$query = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `parent_id` = 2 AND `level` = 2 ");
$rowCount = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

    	$sub_category_id = $row['id'];
    	$sub_category = $row['type'];


    	if ( $sub_category_id == $sub_category_cookie ) {

    		$select = 'select';

    		$close = '<i class="fa fa-close sub-category-clear sub-category-clear-style"></i>';
    	}else{
    		$select = '';
    		$close = '';
    	}

    	$sql = 'SELECT * FROM `item` WHERE `status` = 1';

		if ( isset( $vendor ) ) {

			$sql .= ' AND `vendor_id` = '.$vendor;


		}elseif ( !isset( $vendor ) ) {
			
			if ( isset( $city ) ) {
				$sql .= ' AND `city_id` = '.$city;
			}

			if ( isset( $district ) ) {
				$sql .= ' AND `district_id` = '.$district;
			}

			if ( isset( $province ) ) {
				$sql .= ' AND `province_id` = '.$province;
			}

		}

    	$sql .= ' AND `category_id` = '.$sub_category_id;

    	$query_sub = $db->query($sql);

		$rowCount_sub = $query_sub->num_rows;
		$rowCount_sub = ( $rowCount_sub > 0 ) ? $rowCount_sub : '-' ;


$list_acc .=<<<LIST
<li ><a href="javascript:void(0);" class="set-sub_category $select" data-id="$sub_category_id">$sub_category<span>$rowCount_sub</span></a>$close</li>
LIST;


		  	}
		}
		

$all = <<<ALL
<h5 class="shop-tittle margin-top-60 margin-bottom-30">Accessories</h5>
<ul class="shop-cate">
	$list_acc
</ul>
ALL;

echo $all;	


?>