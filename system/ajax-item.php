<?php

require 'config.php';

/*START - FETCH ALL LABEL DATA DATA DEPENDS TO THE ITEM ID*/

if ( isset($_POST['type']) && $_POST['type'] == 'get_all_label_data' ) {

	$get_id = $_POST['id'];

	$list_main = '';

	$query_unique = $db->query("SELECT DISTINCT `product_label_id` FROM `product_item_label_type` WHERE `status` = 1 AND `product_item_id` = '$get_id' ");

	$rowCount_unique = $query_unique->num_rows;
	if($rowCount_unique > 0){
	    while($row_unique = $query_unique->fetch_assoc()){
	    	$product_label_id = $row_unique['product_label_id'];


	    	$query_label = $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$product_label_id'");
	    	$row_label = $query_label->fetch_assoc();
	    	$product_label = $row_label['type'];

	    	$list_select = '';
	    	$query = $db->query("SELECT * FROM `product_item_label_type` WHERE `product_label_id` = '$product_label_id' AND `product_item_id` = '$get_id' ");
			$rowCount = $query->num_rows;
			$list_select_data = '';
			if($rowCount > 0){
			    while($row = $query->fetch_assoc()){

			    	$tmp_id 				= $row['id'];
			    	$tmp_product_item_id 	= $row['product_item_id'];
					$tmp_product_label_id 	= $row['product_label_id'];
					$tmp_type 				= $row['type'];

$list_select_data .= <<<DATA
<option value="$tmp_id">$tmp_type</option>
DATA;
				}

$list_select .=<<<SELECT
<select class="form-control mb-md" name="data[]" >
	<option>Select</option>
	$list_select_data
</select>
SELECT;

			}

$list_main .= <<<MAIN
<div class="form-group">
	<label class="col-md-3 control-label" >$product_label</label>
	<div class="col-md-6">
		$list_select
	</div>
</div>
MAIN;


	    }
	}

	echo $list_main;

}

/*END - FETCH ALL LABEL DATA DATA DEPENDS TO THE ITEM ID*/



if ( isset($_POST['type']) && $_POST['type'] == 'get_compare_data' ) {
	
	$get_id = $_POST['id'];

	$query = $db->query("SELECT * FROM `product_items` WHERE `id` = '$get_id' ");
	$row = $query->fetch_assoc();
	$category_id = $row['sub_category_id'];

$compatible_1_data = '';
$compatible_2_data = '';

	if ( $category_id == 4 ) {

		$compatible_1 = '';
		$compatible_2 = '';

		$query_1 = $db->query("SELECT * FROM `compatible` WHERE `category_id` = 4 ");
		$rowCount_1 = $query_1->num_rows;
		if($rowCount_1 > 0){
		    while($row_1 = $query_1->fetch_assoc()){
		    	$id_1 = $row_1['id'];
		    	$type_1 = $row_1['type'];

$compatible_1 .= <<<DATA
<option value="$id_1">$type_1</option>
DATA;		    	
		    }
$compatible_1_data = <<<EOD
<div class="form-group">
	<label class="col-md-3 control-label" for="pro-processor" style="font-weight: 800;">Processor *</label>
	<div class="col-md-3">
		<select class="form-control mb-md" name="compatible_1" id="pro-processor">
			<option>Select</option>
			$compatible_1
		</select>
	</div>
</div>
EOD;
		}


		$query_2 = $db->query("SELECT * FROM `compatible` WHERE `category_id` = 6 ");
		$rowCount_2 = $query_2->num_rows;
		if($rowCount_2 > 0){
		    while($row_2 = $query_2->fetch_assoc()){
		    	$id_2 = $row_2['id'];
		    	$type_2 = $row_2['type'];

$compatible_2 .= <<<DATA
<option value="$id_2">$type_2</option>
DATA;		    	
		    }
$compatible_2_data = <<<EOD
<div class="form-group">
	<label class="col-md-3 control-label" for="pro-ram" style="font-weight: 800;">RAM Type *</label>
	<div class="col-md-3">
		<select class="form-control mb-md" name="compatible_2" id="pro-ram">
			<option>Select</option>
			$compatible_2
		</select>
	</div>
</div>
EOD;
		}
		
	}elseif ( $category_id == 6 ) {
		
		$compatible_1 = '';
		$compatible_2 = '';

		$query_1 = $db->query("SELECT * FROM `compatible` WHERE `category_id` = 6 ");
		$rowCount_1 = $query_1->num_rows;
		if($rowCount_1 > 0){
		    while($row_1 = $query_1->fetch_assoc()){
		    	$id_1 = $row_1['id'];
		    	$type_1 = $row_1['type'];

$compatible_1 .= <<<DATA
<option value="$id_1">$type_1</option>
DATA;		    	
		    }
$compatible_1_data = <<<EOD
<div class="form-group">
	<label class="col-md-3 control-label" for="pro-processor" style="font-weight: 800;">RAM Type *</label>
	<div class="col-md-3">
		<select class="form-control mb-md" name="compatible_1" id="pro-processor">
			<option>Select</option>
			$compatible_1
		</select>
	</div>
</div>
EOD;
		}


	}elseif ( $category_id == 8 ) {
		
		$compatible_1 = '';
		$compatible_2 = '';

		$query_1 = $db->query("SELECT * FROM `compatible` WHERE `category_id` = 4 ");
		$rowCount_1 = $query_1->num_rows;
		if($rowCount_1 > 0){
		    while($row_1 = $query_1->fetch_assoc()){
		    	$id_1 = $row_1['id'];
		    	$type_1 = $row_1['type'];

$compatible_1 .= <<<DATA
<option value="$id_1">$type_1</option>
DATA;		    	
		    }
$compatible_1_data = <<<EOD
<div class="form-group">
	<label class="col-md-3 control-label" for="pro-processor" style="font-weight: 800;">Processor Type *</label>
	<div class="col-md-3">
		<select class="form-control mb-md" name="compatible_1" id="pro-processor">
			<option>Select</option>
			$compatible_1
		</select>
	</div>
</div>
EOD;
		}


	}elseif ( $category_id == 13 ) {
		
		$compatible_1 = '';
		$compatible_2 = '';

		$query_1 = $db->query("SELECT * FROM `compatible` WHERE `category_id` = 4 ");
		$rowCount_1 = $query_1->num_rows;
		if($rowCount_1 > 0){
		    while($row_1 = $query_1->fetch_assoc()){
		    	$id_1 = $row_1['id'];
		    	$type_1 = $row_1['type'];

$compatible_1 .= <<<DATA
<option value="$id_1">$type_1</option>
DATA;		    	
		    }
$compatible_1_data = <<<EOD
<div class="form-group">
	<label class="col-md-3 control-label" for="pro-processor" style="font-weight: 800;">Processor Type *</label>
	<div class="col-md-3">
		<select class="form-control mb-md" name="compatible_1" id="pro-processor">
			<option>Select</option>
			$compatible_1
		</select>
	</div>
</div>
EOD;
		}


	}

echo $compatible_1_data.$compatible_2_data;	

}



?>
