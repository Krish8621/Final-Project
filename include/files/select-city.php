<?php

$get_city_id = $_COOKIE['city'];

$query = $db->query("SELECT * FROM `location` WHERE `id` = '$get_city_id' ");
$row = $query->fetch_assoc();
$get_city_name = $row['name'];

}

?>