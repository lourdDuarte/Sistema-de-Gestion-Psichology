<?php 

require_once '../../../class/ObraSocial.php';
require_once '../../../class/PagoOs.php';

$id = $_POST['txtId'];
$obraSocial = $_POST['cboObraSocial'];
$cantidadSesionesAutorizadas = $_POST['txtSesionesAutorizadas'];
$cantidadSesionesAbonadas = $_POST['txtSesionesAbonadas'];

session_start();


if ($idObraSocial == '0'){
	$_SESSION['mensaje_error'] = "DEBE INDICAR LA OBRA SOCIAL";
	header("Location: ../modificar.php?idPago=$id");
	exit;
}

if (empty(trim($cantidadSesionesAutorizadas))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR CANTIDAD DE SESIONES AUTORIZADAS";
	header("Location: ../modificar.php?idPago=$id");
	exit;
}



if (empty(trim($cantidadSesionesAbonadas))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR CANTIDAD DE SESIONES ABONADAS";
	header("Location: ../modificar.php?idPago=$id");
	exit;
}

if ($cantidadSesionesAbonadas > $cantidadSesionesAutorizadas){
	$_SESSION['mensaje_error'] = "CANTIDAD ABONADA NO VALIDA";
	header("Location: ../modificar.php?idPago=$id");
	exit;
}

$pago = PagoOs::obtenerPorId($id);

$pago->setIdObraSocial($obraSocial);
$pago->setSesionesAutorizadas($cantidadSesionesAutorizadas);
$pago->setSesionesAbonada($cantidadSesionesAbonadas);

$obraSocial =ObraSocial::obtenerPorId($pago->getIdObraSocial());
$coseguro = $obraSocial->getCoSeguro();

$nuevoAbono = $pago->calcularAbonoPorSesion($coseguro);

$pago->setMontoSesion($nuevoAbono);

$pago->actualizar();

//highlight_string(var_export($pago,true));
header('location:../listado.php?mensaje=2');

?>