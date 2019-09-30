<?php

$filter 	= $_COOKIE['province'];


$query = $db->query("SELECT * FROM `location` WHERE `id` = '$filter' ");
$row = $query->fetch_assoc();
$name = $row['name'];

if (isset($filter)) {	

$filter = <<<FILTER
<div class="filter-btn" >
	<span class="filter-name set-province" data-id="$filter">$name </span>
	<span class="filter-close"><i class="fa fa-close province-clear"></i></span>
</div>
FILTER;

echo $filter;

}

?>