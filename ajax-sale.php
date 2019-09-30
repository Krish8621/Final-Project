<?php
include 'config.php';


if ( isset($_POST['type']) && $_POST['type'] == 'warning_login_first' ) {

$msg = <<<MSG
<div class="myAlert-top alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Unable to add!</strong> You need to login first.
</div>
MSG;


echo $msg;

}



if ( isset($_POST['type']) && $_POST['type'] == 'add_tmp_sale_assemble_item' ) {

	$get_id = $_POST['item_id'];
	$user_id = $_COOKIE['web_user_id'];

	$query = $db->query("SELECT * FROM `sale_assemble` WHERE `user_id` = '$user_id' AND `item_id` = '$get_id' AND `status` = 0 ");
	$rowCount = $query->num_rows;

	if ( !$rowCount > 0 ) {

	$db->query("INSERT INTO `sale_assemble`( `user_id`, `item_id`, `status`) VALUES ('$user_id', '$get_id', 0)");

$msg = <<<MSG
<div class="myAlert-top alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Item added to item list.
</div>
MSG;

	}else{

$msg = <<<MSG
<div class="myAlert-top alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> Item already in item list.
</div>
MSG;

	}


echo $msg;

}


if ( isset($_POST['type']) && $_POST['type'] == 'remove_tmp_sale_assemble_item' ) {

	$get_id = $_POST['item_id'];

	$db->query("DELETE FROM `sale_assemble` WHERE `id` = '$get_id' ");


$msg = <<<MSG
<div class="myAlert-top alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Removed!</strong> Item removed from item list.
</div>
MSG;

echo $msg;

}

?>