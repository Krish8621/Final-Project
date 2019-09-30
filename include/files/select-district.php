<?php

$get_district_id = $_COOKIE['district'];

$query = $db->query("SELECT * FROM `location` WHERE `id` = '$get_district_id' ");
$row = $query->fetch_assoc();
$get_district_name = $row['name'];

}

?>