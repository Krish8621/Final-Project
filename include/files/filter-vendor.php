<?php

$filter     = $_COOKIE['vendor'];

$query = $db->query("SELECT * FROM `user` WHERE `id` = '$filter' ");
$row = $query->fetch_assoc();
$name = $row['name'];

if (isset($filter)) {   

$filter = <<<FILTER
<div class="filter-btn">
    <span class="filter-name set-vendor" data-id="$filter">$name </span>
    <span><i class="fa fa-close vendor-clear "></i></span>
</div>
FILTER;

echo $filter;

}

?>