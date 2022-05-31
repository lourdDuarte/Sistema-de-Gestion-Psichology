<?php

session_start();

require_once '../../../class/ObraSocial.php';

$nombre = $_POST['txtNombre'];
$coSeguro = $_POST['txtCoSeguro'];

session_start();

if (empty(trim($nombre))){
	$_SESSION['mensaje_error']="DEBE INGRESAR NOMBRE DE LA OBRA SOCIAL";
	header("location:../alta.php");
	exit;
}

function validarObraSocial($nombre){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM obrasocial WHERE nombre = '$nombre'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarObraSocial($nombre) == 1){
 	$_SESSION['mensaje_error']= "OBRA SOCIAL YA REGISTRADA";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if (empty(trim($coSeguro))){
	$_SESSION['mensaje_error']="DEBE INGRESAR EL CO SEGURO";
	header("location:../alta.php");
	exit;
}


$obraSocial= new ObraSocial;
$obraSocial->setNombre($nombre);
$obraSocial->setCoSeguro($coSeguro);

$obraSocial->guardar();

//highlight_string(var_export($obraSocial,true));



header('location: ../listado.php?mensaje=1');

?>

