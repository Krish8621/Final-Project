<?php

define(DB_CONNECTION, "admin/connection.php" );

function delete( $id, $table ){

	//Database Connection
	require DB_CONNECTION;

	//Delete Query
	$query = "DELETE FROM `$table` WHERE `id` = '$id' ";

	//$db->query($query);
}

?>