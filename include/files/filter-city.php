<?php

$filter 	= $_COOKIE['city'];


$query = $db->query("SELECT * FROM `location` WHERE `id` = '$filter' ");
$row = $query->fetch_assoc();
$name = $row['name'];

if (isset($filter)) {	

$filter = <<<FILTER
<div class="filter-btn">
	<span class="filter-name set-city" data-id="$filter">$name </span>
	<span><i class="fa fa-close city-clear"></i></span>
</div>
FILTER;

echo $filter;

}

?>