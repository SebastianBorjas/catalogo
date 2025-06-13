<?php

include 'conexion.php';

$cp = $_GET['cp'];
mysqli_set_charset("utf8");
$result = $db->query("Select * From Sepomex where cp = '$cp' LIMIT 1");
if (mysqli_num_rows($result) > 0) {
	$direccion = mysqli_fetch_object($result);
	$direccion->status = 200;
	echo json_encode($direccion);
}else{
	$error = array('status' => 400);
	echo json_encode((object)$error);
}
