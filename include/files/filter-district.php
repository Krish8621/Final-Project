<?php
$filter 	= $_COOKIE['district'];


$query = $db->query("SELECT * FROM `location` WHERE `id` = '$filter' ");
$row = $query->fetch_assoc();
$name = $row['name'];

if (isset($filter)) {	

$filter = <<<FILTER
<div class="filter-btn">
	<span class="filter-name set-district" data-id="$filter">$name </span>
	<span><i class="fa fa-close district-clear"></i></span>
</div>
FILTER;

echo $filter;

}

?>