<?php

require 'config.php';

/*START - FETCH SUB CATEGORY DATA*/

if ( isset($_POST['type']) && $_POST['type'] == 'get_sub_category_data' ) {

	$get_id = $_POST['id'];

	$data = '';

	$query = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `parent_id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){
	    	$id = $row['id'];
	    	$type = $row['type'];

$data .= <<<DATA
<option value="$id">$type</option>
DATA;
	    }
	}

echo '<option>Select</option>'.$data;


}

/*END - FETCH SUB CATEGORY DATA*/


/*START - LABEL ADD*/


if ( isset($_POST['new_other']) ) {

	$tmp_val = $_POST['new_other'];

$query = $db->query("SELECT * FROM `product_item_label` WHERE `status` = 1 ORDER BY `type` ASC ");
$rowCount = $query->num_rows;

$list_val = '';
if($rowCount > 0){

    while($row = $query->fetch_assoc()){

    	$id = $row['id'];
    	$type = $row['type'];

$list_val .= <<<VAL
<option class="" value="$id" >$type</option>
VAL;
    }

}
$list_data .= <<<LIST
<div class="col-md-12 mt-5">
	<div class="col-md-4">
		<div class="form-group">
			<select class="other-data form-control mb-md" name="label_id[]" style="width: 100%;padding: 5px 2px;">
				<option>SELECT</option>
				$list_val
			</select>
		</div>
	</div>
	<div class="col-md-7" >
		<div class="col-md-12">
			<input type="text" class="form-control" name="label_value[]" placeholder="Type Value here" autocomplete="off">
		</div>
	</div>
		
	<a href="javascript:void(0);" class="btn btn-danger remove-option-other pull-right" style=""><i class="fa fa-minus " style="margin: 0;"></i></a>
</div>
LIST;

echo $list_data;

}
/*END - LABEL ADD*/


?>
