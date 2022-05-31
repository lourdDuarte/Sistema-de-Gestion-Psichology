<?php

require_once "../../../class/Barrio.php";
require_once "../../../class/MySQL.php";

session_start();

$descripcion = $_POST['txtDescripcion'];

//VALIDACIONES
if(empty(trim($descripcion))) {
	$_SESSION['mensaje_error'] = "El nombre no debe estar vacio";
	header("Location: ../alta.php");
	exit;
} elseif (strlen(trim($descripcion)) < 3) {
	$_SESSION['mensaje_error'] = "El nombre debe contener al menos 3 caracteres";
	header("Location: ../alta.php");
	exit;
}

function validarBarrio($descripcion){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM barrio WHERE descripcion = '$descripcion'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarBarrio($descripcion) == 1){
 	$_SESSION['mensaje_error']= "BARRIO YA REGISTRADO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

$barrio = new Barrio($descripcion);

$barrio->guardar();

header("Location:../listado.php?mensaje=1");

?>