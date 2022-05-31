<?php

require_once '../../../class/Paciente.php';
require_once '../../../class/ObraSocialPaciente.php';
require_once '../../../class/Ficha.php';

$id= $_POST['txtId'];
$idFicha = $_POST['txtIdFicha'];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$tipoDocumento = $_POST['cboTipoDocumento'];
$numeroDocumento = $_POST['txtNumeroDocumento'];
$descripcion = $_POST['txtDescripcion'];

session_start();

if (empty(trim($nombre))) {
	$_SESSION['mensaje_error']= "ERROR NOMBRE VACIO";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	
	exit;
}

if (strlen(trim($nombre)) < 3 ) {
	$_SESSION['mensaje_error']="El nombre debe contener al menos 3 caracteres";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}


if (empty(trim($apellido))) {
	$_SESSION['mensaje_error']= "ERROR APELLIDO VACIO";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");

	exit;
}





if (empty(trim($fechaNacimiento))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA DE NACIMIENTO";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}

//validacion de error en fecha 
date_default_timezone_set('America/Argentina/Buenos_Aires');

$fechaActual= date("Y-m-d");

if ($fechaNacimiento >= $fechaActual ) {
    $_SESSION['mensaje_error'] = "LA FECHA INGRESADA NO ES VALIDA";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}


if ($tipoDocumento == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR EL TIPO DE DOCUMENTO";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}

if(empty(trim($numeroDocumento))){
	$_SESSION['mensaje_error'] = "NUMERO DE DOCUMENTO VACIO";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}


if (strlen(trim($numeroDocumento)) < 8 ) {
	$_SESSION['mensaje_error']="EL DOCUMENTO DEBE TENER AL MENOS 8 CARACTERES";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}

$paciente = Paciente::ObtenerPorId($id);
$paciente->setNombre($nombre);
$paciente->setApellido($apellido);
$paciente->setFechaNacimiento($fechaNacimiento);
$paciente->setIdTipoDocumento($tipoDocumento);
$paciente->setNumeroDocumento($numeroDocumento);
$paciente->setDescripcion($descripcion);

$paciente->actualizar();

//highlight_string(var_export($paciente,true));

$listaObraSocial = $_POST ['cboObraSocial'];
$numeroAsociado = $_POST['txtNumeroAsociado'];

if (empty(trim($numeroAsociado))) {
	$_SESSION['mensaje_error']= "ERROR NUMERO ASOCIADO VACIO";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");

	exit;
}


$paciente->eliminarObraSocial();

foreach ($listaObraSocial as $obraSocial_id){
	$obraSocialPaciente = new obraSocialPaciente();
	$obraSocialPaciente->setIdPaciente($paciente->getIdPaciente());
	$obraSocialPaciente->setIdObraSocial($obraSocial_id);
	$obraSocialPaciente->setNumeroAsociado($numeroAsociado);
	$obraSocialPaciente->guardar(); 
}

//actualizar ficha 


$profesionalAsignado = $_POST['cboProfesional'];
$tipoAtencion = $_POST['cboTipoAtencion'];

if ($profesionalAsignado == '0'){
	$_SESSION['mensaje_error'] = "DEBE SELECCIONAR EL PROFESIONAL DE ATENCION";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}

if ($tipoAtencion == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR EL TIPO DE ATENCION";
	header("Location: ../modificar.php?id=$id&idFicha=$idFicha");
	exit;
}


$ficha = Ficha::ObtenerPorId($idFicha);

$ficha->setIdProfesional($profesionalAsignado);
$ficha->setIdTipoAtencion($tipoAtencion);

$ficha->actualizar();


//highlight_string(var_export($ficha,true));

header('location: ../listado.php?mensaje=2');
?>

