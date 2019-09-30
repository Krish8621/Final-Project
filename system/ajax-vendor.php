<?php

require 'config.php';

/*START - FETCH DISTRICT DATA*/

if ( isset($_POST['type']) && $_POST['type'] == 'get_distict_data' ) {

	$get_id = $_POST['id'];

	$data = '';

	$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){
	    	$id = $row['id'];
	    	$name = $row['name'];

$data .= <<<DATA
<option value="$id">$name</option>
DATA;
	    }
	}

echo '<option>Select</option>'.$data;


}

/*END - FETCH DISTRICT DATA*/


/*START - FETCH CITY DATA*/

if ( isset($_POST['type']) && $_POST['type'] == 'get_city_data' ) {

	$get_id = $_POST['id'];

	$data = '';

	$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = '$get_id' ");
	$rowCount = $query->num_rows;
	if($rowCount > 0){
	    while($row = $query->fetch_assoc()){
	    	$id = $row['id'];
	    	$name = $row['name'];

$data .= <<<DATA
<option value="$id">$name</option>
DATA;
	    }
	}

echo '<option>Select</option>'.$data;


}

/*END - FETCH CITY DATA*/


?>
