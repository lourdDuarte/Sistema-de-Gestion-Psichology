<?php


require_once "../../../class/Domicilio.php";;

$idPersona = $_POST['txtIdPersona'];
$idLlamada = $_POST['txtIdLlamada'];
$modulo = $_POST['txtModulo'];
$calle = $_POST['txtCalle'];
$altura = $_POST['txtAltura'];
$piso = $_POST['txtPiso'];
$manzana = $_POST['txtManzana'];
$idBarrio = $_POST['cboBarrio'];

session_start();

if (empty(trim($calle))) {
	$_SESSION['mensaje_error'] = "el nombre de la calle no debe estar vacio";
	header('Location: ../alta.php');
	exit;
} elseif (strlen(trim($calle)) < 4) {
	$_SESSION['mensaje_error'] = "el nombre de la calle debe contener al menos 4 caracteres";
	header('Location: ../alta.php');
	exit;
}

if ((int) $idBarrio == 0) {
	$_SESSION['mensaje_error'] = "debe indicar el barrio";
	header("location: ../alta.php");
	exit;
}

$domicilio = new Domicilio();

$domicilio->setCalle($calle);
$domicilio->setAltura($altura);
$domicilio->setPiso($piso);
$domicilio->setManzana($manzana);
$domicilio->setIdPersona($idPersona);
$domicilio->setIdBarrio($idBarrio);

$domicilio->guardar();

// redireccionar


header("location: /programacion3/gestion/modulos/$modulo/detalle.php?id=$idLlamada");




?>