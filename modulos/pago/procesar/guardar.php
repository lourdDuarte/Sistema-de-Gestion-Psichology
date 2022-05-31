<?php

require_once '../../../class/ObraSocial.php';
require_once '../../../class/PagoOs.php';


$idPaciente = $_POST['cboPaciente'];
$idObraSocial = $_POST['cboObraSocial'];
$cantidadSesionesAutorizadas = $_POST['txtSesionesAutorizadas'];
$cantidadSesionesAbonadas = $_POST['txtSesionesAbonadas'];
$fecha = $_POST['txtFecha'];

session_start();

if ($idPaciente == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR EL PACIENTE";
	header('location:../alta.php');
	exit;
}

if ($idObraSocial == '0'){
	$_SESSION['mensaje_error'] = "DEBE INDICAR LA OBRA SOCIAL";
	header('location:../alta.php');
	exit;
}

if (empty(trim($cantidadSesionesAutorizadas))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR CANTIDAD DE SESIONES AUTORIZADAS";
	header('location:../alta.php');
	exit;
}

if (empty(trim($fecha))){
	$_SESSION['mensaje_error'] = "INDIQUE LA FECHA";
	header('location:../alta.php');
	exit;
}


if (empty(trim($cantidadSesionesAbonadas))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR CANTIDAD DE SESIONES ABONADAS";
	header('location:../alta.php');
	exit;
}

if ($cantidadSesionesAbonadas > $cantidadSesionesAutorizadas){
	$_SESSION['mensaje_error'] = "CANTIDAD ABONADA NO VALIDA";
	header('location:../alta.php');
	exit;
}


$nuevoPago = new PagoOs();
$nuevoPago->setIdPaciente($idPaciente);
$nuevoPago->setIdObraSocial($idObraSocial);
$nuevoPago->setSesionesAutorizadas($cantidadSesionesAutorizadas);
$nuevoPago->setSesionesAbonada($cantidadSesionesAbonadas);
$nuevoPago->setFecha($fecha);



$obraSocial = ObraSocial::obtenerPorId($nuevoPago->getIdObraSocial());
$coseguro = $obraSocial->getCoSeguro();

$total = $nuevoPago->calcularTotal($coseguro);
$totalAbono = $nuevoPago->calcularAbonoPorSesion($coseguro);

$nuevoPago->setMontoSesion($totalAbono);

$nuevoPago->setTotal($total);

$nuevoPago->guardar();



//highlight_string(var_export($nuevoPago,true));
header('location:../listado.php');





?>