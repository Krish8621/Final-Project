<?php

$filter 	= $_COOKIE['sub_category'];

$query = $db->query("SELECT * FROM `product_category` WHERE `id` = '$filter' ");
$row = $query->fetch_assoc();
$name = $row['type'];

if (isset($filter)) {	

$filter = <<<FILTER
<div class="filter-btn">
	<span class="filter-name set-sub_category" data-id="$filter">$name </span>
	<span><i class="fa fa-close sub-category-clear "></i></span>
</div>
FILTER;

echo $filter;

}

?>