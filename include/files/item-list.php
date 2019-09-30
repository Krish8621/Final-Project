<?php

$web_user_id            = $_COOKIE['web_user_id'];

$vendor_cookie 			= $_COOKIE['vendor'];
$sub_category_cookie 	= $_COOKIE['sub_category'];
$city_cookie 			= $_COOKIE['city'];
$district_cookie 		= $_COOKIE['district'];
$province_cookie 		= $_COOKIE['province'];


$sql = 'SELECT * FROM `item` WHERE `status` = 1';

if ( isset( $vendor_cookie ) ) {

	$sql .= ' AND `vendor_id` = '.$vendor_cookie;


}elseif ( !isset( $vendor_cookie ) ) {
	
	if ( isset( $city_cookie ) ) {
		$sql .= ' AND `city_id` = '.$city_cookie;
	}

	if ( isset( $district_cookie ) ) {
		$sql .= ' AND `district_id` = '.$district_cookie;
	}

	if ( isset( $province_cookie ) ) {
		$sql .= ' AND `province_id` = '.$province_cookie;
	}

}

if ( isset( $sub_category_cookie ) ) {
	$sql .= ' AND `category_id` = '.$sub_category_cookie;
}


$sql .= ' ORDER BY `id` DESC LIMIT 15 ';

$list = '';

$query = $db->query($sql);
$rowCount = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

    	$id = $row['id'];
    	$vendor_id = $row['vendor_id'];
    	$item_id = $row['item_id'];
    	$amount_val = $row['amount'];
    	$item_category_id = $row['category_id'];

    	$label_1 = $row['label_1'];
    	$label_2 = $row['label_2'];
    	$label_3 = $row['label_3'];
    	$label_4 = $row['label_4'];
    	$label_5 = $row['label_5'];

    	$amount = number_format($amount_val, 2, '.', ',');

    	//Label Type

    	$query_label_1 				= $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_1' ");
		$row_label_1				= $query_label_1->fetch_assoc();
		$label_l_1_label_id			= $row_label_1['product_label_id'];
		$label_l_1					= $row_label_1['type'];

		$query_label_2 				= $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_2' ");
		$row_label_2				= $query_label_2->fetch_assoc();
		$label_l_2_label_id			= $row_label_2['product_label_id'];
		$label_l_2					= $row_label_2['type'];

		$query_label_3 				= $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_3' ");
		$row_label_3				= $query_label_3->fetch_assoc();
		$label_l_3_label_id			= $row_label_3['product_label_id'];
		$label_l_3					= $row_label_3['type'];

    	$query_label_4 				= $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_4' ");
		$row_label_4				= $query_label_4->fetch_assoc();
		$label_l_4_label_id			= $row_label_4['product_label_id'];
		$label_l_4					= $row_label_4['type'];

		$query_label_5 				= $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_5' ");
		$row_label_5				= $query_label_5->fetch_assoc();
		$label_l_5_label_id			= $row_label_5['product_label_id'];
		$label_l_5					= $row_label_5['type'];



    	//Label

    	$query_label_l_1_label	= $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_1_label_id' ");
		$row_label_l_1_label	= $query_label_l_1_label->fetch_assoc();
		$label_l_1_label 		= $row_label_l_1_label['type'];

		$query_label_l_2_label	= $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_2_label_id' ");
		$row_label_l_2_label	= $query_label_l_2_label->fetch_assoc();
		$label_l_2_label 		= $row_label_l_2_label['type'];

		$query_label_l_3_label	= $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_3_label_id' ");
		$row_label_l_3_label	= $query_label_l_3_label->fetch_assoc();
		$label_l_3_label 		= $row_label_l_3_label['type'];

		$query_label_l_4_label	= $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_4_label_id' ");
		$row_label_l_4_label	= $query_label_l_4_label->fetch_assoc();
		$label_l_4_label 		= $row_label_l_4_label['type'];

		$query_label_l_5_label	= $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_5_label_id' ");
		$row_label_l_5_label	= $query_label_l_5_label->fetch_assoc();
		$label_l_5_label 		= $row_label_l_5_label['type'];



    	$label_l_2_n = ( $label_l_2 > 0 ) ? ' - '.$label_l_2 : '';
    	$label_l_3_n = ( $label_l_3 > 0 ) ? ' - '.$label_l_3 : '';
    	$label_l_4_n = ( $label_l_4 > 0 ) ? ' - '.$label_l_4 : '';
    	$label_l_5_n = ( $label_l_5 > 0 ) ? ' - '.$label_l_5 : '';

    	$all_labels = $label_l_1 . $label_l_2_n . $label_l_3_n . $label_l_4_n . $label_l_5_n;


    	//Product Item
    	$query_i = $db->query("SELECT * FROM `product_items` WHERE `id` = '$item_id' ");
    	$row_i = $query_i->fetch_assoc();
    	$item_title = $row_i['title'];
    	$item_brand_id = $row_i['brand_id'];

    	//Product Brand
    	$query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$item_brand_id' ");
    	$row_b = $query_b->fetch_assoc();
    	$brand_name = $row_b['title'];

    	//Product Category
    	$query_c = $db->query("SELECT * FROM `product_category` WHERE `id` = '$item_category_id' ");
    	$row_c = $query_c->fetch_assoc();
    	$category_name = $row_c['type'];


	
    	//Vendor
    	$query_vendor = $db->query("SELECT * FROM `user` WHERE `id` = '$vendor_id' ");
    	$row_vendor = $query_vendor->fetch_assoc();
    	$vendor_province 	= $row_vendor['province_id'];
    	$vendor_district 	= $row_vendor['district_id'];
    	$vendor_city 		= $row_vendor['city_id'];
    	$vendor_name 		= $row_vendor['name'];


    	$label_list_1 = '<li> '.$label_l_1_label.' - <span style="color:#2d3a4b;font-weight: 600;">'.$label_l_1.'</span> </li>';
    	$label_list_2 = ( $label_l_2 > 0 ) ? '<li> '.$label_l_2_label.' - <span style="color:#2d3a4b;font-weight: 600;">'.$label_l_2.'</span> </li>': '';
    	$label_list_3 = ( $label_l_3 > 0 ) ? '<li> '.$label_l_3_label.' - <span style="color:#2d3a4b;font-weight: 600;">'.$label_l_3.'</span> </li>': '';
    	$label_list_4 = ( $label_l_4 > 0 ) ? '<li> '.$label_l_4_label.' - <span style="color:#2d3a4b;font-weight: 600;">'.$label_l_4.'</span> </li>': '';
    	$label_list_5 = ( $label_l_5 > 0 ) ? '<li> '.$label_l_5_label.' - <span style="color:#2d3a4b;font-weight: 600;">'.$label_l_5.'</span> </li>': '';


        //Add Authentication Class
        $auth = ( isset( $web_user_id ) ) ? 'add-assemble' : 'auth-login' ;



$list .= <<<DATA
<div class="item list-group-item " style="">
  <div class="img-ser"> 
  <div class="on-sale"> $category_name </div>
    <!-- Item Details -->
    <div class="cap-text">
    	<div class="item-name-new">
    		<div class="col-md-9" style="overflow: hidden;float:left;padding-left: 0;width:410px;">
    			<a href="#." class="i-tittle">$item_title - $brand_name $all_labels </a> 
    		</div>
    		<div class="col-md-3" style="float:right;">
    			<div class="add-cart-new">
					<a class="$auth" href="javascript:void(0);" data-id="$id" ><i class="icon-basket margin-right-10"></i> ADD</a>
				</div>
    		</div>
  			
      		<span class="price"><small>Rs</small>$amount</span> 
      		<span class="price">$vendor_name</span>
        	<!-- Details -->

	        <!-- List Style -->
	        <ul class="list-style">
	          	$label_list_1 
	          	$label_list_2
	          	$label_list_3
	          	$label_list_4
	          	$label_list_5
	        </ul>
      </div>
    </div>
  </div>
</div>
DATA;
    }
}


echo $list;



?>