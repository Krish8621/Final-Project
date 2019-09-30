<?php

$get_province_id = $_COOKIE['province'];

$query = $db->query("SELECT * FROM `location` WHERE `id` = '$get_province_id' ");
$row = $query->fetch_assoc();
$get_province_name = $row['name'];

}

?>