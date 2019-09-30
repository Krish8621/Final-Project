<?php
include 'config.php';



if ( isset($_POST['type']) && $_POST['type'] == 'get_item_data' ) {

	$get_id = $_POST['item_id'];


	$query = $db->query("SELECT * FROM `item` WHERE `id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
		$nos = 0;
	    while($row = $query->fetch_assoc()){

	    	$id = $row['id'];
	    	$vendor_id = $row['vendor_id'];
	    	$item_id = $row['item_id'];
	    	$amount = $row['amount'];

	    	$label_1 = $row['label_1'];
	    	$label_2 = $row['label_2'];
	    	$label_3 = $row['label_3'];
	    	$label_4 = $row['label_4'];
	    	$label_5 = $row['label_5'];


	    	$amount = number_format($amount, 2, '.', ',');

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



$table_row_1 = <<<EOD
<tr style="line-height: 30px;">
	<td style="width: 5%;"><i class="fa fa-arrow-right" style="color:#ccc;"></i></td>
	<td style="width: 35%;">$label_l_1_label</td>
	<td style="width: 5%;text-align: center;"> - </td>
	<td style="width: 55%;">$label_l_1</td>
</tr>
EOD;


$table_row_2 = '';
if ( $label_l_2 > 0) {

$table_row_2 = <<<EOD
<tr style="line-height: 30px;">
	<td style="width: 5%;"><i class="fa fa-arrow-right" style="color:#ccc;"></i></td>
	<td style="width: 35%;">$label_l_2_label</td>
	<td style="width: 5%;text-align: center;"> - </td>
	<td style="width: 55%;">$label_l_2</td>
</tr>
EOD;

}

$table_row_3 = '';
if ( $label_l_3 > 0) {

$table_row_3 = <<<EOD
<tr style="line-height: 30px;">
	<td style="width: 5%;"><i class="fa fa-arrow-right" style="color:#ccc;"></i></td>
	<td style="width: 35%;">$label_l_3_label</td>
	<td style="width: 5%;text-align: center;"> - </td>
	<td style="width: 55%;">$label_l_3</td>
</tr>
EOD;

}

$table_row_4 = '';
if ( $label_l_4 > 0) {

$table_row_4 = <<<EOD
<tr style="line-height: 30px;">
	<td style="width: 5%;"><i class="fa fa-arrow-right" style="color:#ccc;"></i></td>
	<td style="width: 35%;">$label_l_4_label</td>
	<td style="width: 5%;text-align: center;"> - </td>
	<td style="width: 55%;">$label_l_4</td>
</tr>
EOD;

}

$table_row_5 = '';
if ( $label_l_5 > 0) {

$table_row_5 = <<<EOD
<tr>
	<td style="width: 5%;"><i class="fa fa-arrow-right" style="color:#ccc;"></i></td>
	<td style="width: 35%;">$label_l_5_label</td>
	<td style="width: 5%;text-align: center;"> - </td>
	<td style="width: 55%;">$label_l_5</td>
</tr>
EOD;

}


	    	//Product Item
	    	$query_i = $db->query("SELECT * FROM `product_items` WHERE `id` = '$item_id' ");
	    	$row_i = $query_i->fetch_assoc();
	    	$item_title = $row_i['title'];
	    	$item_brand_id = $row_i['brand_id'];
	    	$item_category_id = $row_i['category_id'];
	    	$item_sub_category_id = $row_i['sub_category_id'];
	    	$item_description = $row_i['description'];

	    	//Product Brand
	    	$query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$item_brand_id' ");
	    	$row_b = $query_b->fetch_assoc();
	    	$brand_name = $row_b['title'];

	    	//Product Category
	    	$query_c = $db->query("SELECT * FROM `product_category` WHERE `id` = '$item_category_id' ");
	    	$row_c = $query_c->fetch_assoc();
	    	$category_name = $row_c['type'];

	    	//Product Sub Category
	    	$query_s = $db->query("SELECT * FROM `product_category_sub` WHERE `id` = '$item_sub_category_id' ");
	    	$row_s = $query_s->fetch_assoc();
	    	$sub_category_name = $row_s['type'];
	    }
	}

$data = <<<EOD
<div class="row">
    <div class="col-md-6">                 
      <img src="images/item-img-1-1.jpg" alt="">
    </div>
    
    <!-- Content Info -->
    <div class="col-md-6">
      <div class="contnt-info">
        <h3 class="model-item-title">$item_title - $brand_name $all_labels</h3>
        <table class="model-item-table">        	
        	$table_row_1
        	$table_row_2
        	$table_row_3
        	$table_row_4
        	$table_row_5
        </table>
        <p class="model-item-description">$item_description</p>
    
        
        <!-- Btn  -->
        <div class="add-info text-right">
        	<a href="#." class="btn pull-left">VIEW DETAIL </a>
          <a href="javascript:void(0);" data-id="$id" class="btn add-assemble">ASSEMBLE </a> </div>
      </div>
    </div>
  </div>

<script>
	$('.add-assemble').on('click', function(){

	  var item_id = $(this).data('id');

	  $.ajax({
	      url:'ajax-sale.php',
	      type:'POST',
	      data:'type=add_tmp_sale_assemble_item&item_id='+item_id,
	      success:function (data) {
	        $('#msg-alert').html(data);
	        myAlertTop();
	      }
	  });    

	});
</script>
EOD;

echo $data;
	
}



?>