<?php
include 'config.php';

if ( isset($_POST['type']) && $_POST['type'] == 'get_locations' ) {

	$get_id = $_POST['id'];

	if ( $get_id == 2 || $get_id == 3 ) {

		$list = '';

		$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = 0 ");
		$rowCount = $query->num_rows;
		if($rowCount > 0){
			while($row = $query->fetch_assoc()){

				$id = $row['id'];
				$name = $row['name'];
$list .= <<<EOD
<option value="$id">$name</option>
EOD;
			}
		}

$data =<<<EOD
<div class="form-group">
	<label> PROVINCE</label>
	<select class="form-control" name="province_id" id="get-province" required>
		<option>SELECT</option>
		$list
	</select>
</div>
EOD;

echo $data;
	}else{
		echo "";
	}
}


if ( isset($_POST['type']) && $_POST['type'] == 'get_district' ) {

	$get_id = $_POST['id'];

	if ( $get_id > 0 ) {

	$list = '';

	$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
		while($row = $query->fetch_assoc()){

			$id = $row['id'];
			$name = $row['name'];
$list .= <<<EOD
<option value="$id">$name</option>
EOD;
		}
	}

$data =<<<EOD
<div class="form-group">
	<label> DISTRICT</label>
	<select class="form-control" name="district_id" id="get-district" required>
		<option>SELECT</option>
		$list
	</select>
</div>
EOD;

echo $data;
	}else{
		echo "";
	}
}

if ( isset($_POST['type']) && $_POST['type'] == 'get_city' ) {

	$get_id = $_POST['id'];

	if ( $get_id > 0 ) {

	$list = '';

	$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
		while($row = $query->fetch_assoc()){

			$id = $row['id'];
			$name = $row['name'];
$list .= <<<EOD
<option value="$id">$name</option>
EOD;
		}
	}

$data =<<<EOD
<div class="form-group">
	<label> CITY</label>
	<select class="form-control" name="city_id" id="get-city" required>
		<option>SELECT</option>
		$list
	</select>
</div>
EOD;

echo $data;
	}else{
		echo "";
	}
}





if ( isset($_POST['type']) && $_POST['type'] == 'get_general_data_name' ) {

	$get_id = $_POST['id'];

	if ( $get_id == 2 || $get_id == 3 ) {

$data =<<<EOD
<label> Name
	<input type="text" name="name" placeholder="your name" class="form-control" autocomplete="off">
</label>
EOD;

echo $data;
	}else{
		echo "";
	}
}
if ( isset($_POST['type']) && $_POST['type'] == 'get_general_data_contact' ) {

	$get_id = $_POST['id'];

	if ( $get_id == 2 || $get_id == 3 ) {

$data =<<<EOD
<label> Contact Number
	<input type="text" name="contact" placeholder="0712345678" class="form-control" autocomplete="off">
</label>
EOD;

echo $data;
	}else{
		echo "";
	}
}


?>
