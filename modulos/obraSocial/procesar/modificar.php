<?php

session_start();

require_once '../../../class/ObraSocial.php';

$id= $_POST['txtId'];
$nombre= $_POST['txtNombre'];
$coSeguro= $_POST['txtCoSeguro'];

if (empty(trim($nombre))){
	$_SESSION['mensaje_error']="DEBE INGRESAR NOMBRE DE LA OBRA SOCIAL";
	header("location:../modificar.php?id=$id");
	exit;
}

if (empty(trim($coSeguro))){
	$_SESSION['mensaje_error']="DEBE INGRESAR EL CO SEGURO";
	header("location:../modificar.php?id=$id");
	exit;
}

$obraSocial= ObraSocial::ObtenerPorId($id);
$obraSocial->setNombre($nombre);
$obraSocial->setCoSeguro($coSeguro);

$obraSocial->actualizar();

//highlight_string(var_export($obraSocial,true));

header('location: ../listado.php?mensaje=2');

?>

