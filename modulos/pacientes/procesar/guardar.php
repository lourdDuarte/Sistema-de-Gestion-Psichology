<?php

require_once "../../../class/Paciente.php";
require_once '../../../class/obraSocialPaciente.php';
require_once '../../../class/Ficha.php';
session_start();
 
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$tipoDocumento = $_POST['cboTipoDocumento'];
$numeroDocumento = $_POST['txtNumeroDocumento'];
$descripcion = $_POST['txtDescripcion'];



if (empty(trim($nombre))) {
	$_SESSION['mensaje_error']= "ERROR NOMBRE VACIO";
	header('location:../alta.php');
	
	exit;
}

if (strlen(trim($nombre)) < 3 ) {
	$_SESSION['mensaje_error']="El nombre debe contener al menos 3 caracteres";
	header('location:../alta.php');
	exit;
}


if (empty(trim($apellido))) {
	$_SESSION['mensaje_error']= "ERROR APELLIDO VACIO";
	header('location:../alta.php');

	exit;
}

$listaObraSocial = $_POST['cboObraSocial'];
$numeroAsociado = $_POST['txtNumeroAsociado'];


if (empty(trim($numeroAsociado))) {
	$_SESSION['mensaje_error']= "ERROR NUMERO ASOCIADO VACIO";
	header('location:../alta.php');

	exit;
}

function validarNumeroAsociado($numero){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM paciente_os WHERE numero_asociado = '$numero'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarNumeroAsociado($numeroAsociado) == 1){
 	$_SESSION['mensaje_error']= "NUMERO DE ASOCIADO YA EXISTENTE";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}




//Ficha del Paciente

$profesionalAsignado = $_POST['cboProfesional'];
$tipoAtencion = $_POST['cboTipoAtencion'];
$fechaAlta = $_POST['txFechaAdmision'];

if ($profesionalAsignado == '0'){
	$_SESSION['mensaje_error'] = "DEBE SELECCIONAR EL PROFESIONAL DE ATENCION";
	header('location:../alta.php');
	exit;
}

if ($tipoAtencion == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR EL TIPO DE ATENCION";
	header('location:../alta.php');
	exit;
}

if (empty(trim($fechaAlta))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA DE ADMISION";
	header('location:../alta.php');
	exit;
}


if (empty(trim($fechaNacimiento))){
	$_SESSION['mensaje_error'] = "DEBE INDICAR LA FECHA DE NACIMIENTO";
	header('location:../alta.php');
	exit;
}

//validacion de error en fecha 
date_default_timezone_set('America/Argentina/Buenos_Aires');

$fechaActual= date("Y-m-d");

if ($fechaNacimiento >= $fechaActual ) {
    $_SESSION['mensaje_error'] = "LA FECHA INGRESADA NO ES VALIDA";
	header('location:../alta.php');
	exit;
}


if ($tipoDocumento == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR EL TIPO DE DOCUMENTO";
	header('location:../alta.php');
	exit;
}

if(empty(trim($numeroDocumento))){
	$_SESSION['mensaje_error'] = "NUMERO DE DOCUMENTO VACIO";
	header('location:../alta.php');
	exit;
}

//numero de documento existente en base de datos


function validarNumeroDocumento($documento){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM persona where numero_documento = '$documento'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarNumeroDocumento($numeroDocumento) == 1){
 	$_SESSION['mensaje_error']= "NUMERO DE DOCUMENTO EXISTENTE";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}


if (strlen(trim($numeroDocumento)) < 8 ) {
	$_SESSION['mensaje_error']="EL DOCUMENTO DEBE TENER AL MENOS 8 CARACTERES";
	header('location:../alta.php');
	exit;
}



//highlight_string(var_export($nuevaFicha,true));

$paciente = new Paciente($nombre, $apellido);
$paciente->setFechaNacimiento($fechaNacimiento);
$paciente->setIdTipoDocumento($tipoDocumento);
$paciente->setNumeroDocumento($numeroDocumento);
$paciente->setDescripcion($descripcion);

$paciente->guardar();

//add obra social


foreach ($listaObraSocial as $obraSocial_id) {
	$obraSocialPaciente= new obraSocialPaciente();
	$obraSocialPaciente->setIdPaciente($paciente->getIdPaciente());
	$obraSocialPaciente->setIdObraSocial($obraSocial_id);
	$obraSocialPaciente->setNumeroAsociado($numeroAsociado);
	$obraSocialPaciente->guardar();
}


$nuevaFicha = new Ficha();

$nuevaFicha->setIdPaciente($paciente->getIdPaciente());
$nuevaFicha->setIdProfesional($profesionalAsignado);
$nuevaFicha->setIdTipoAtencion($tipoAtencion);
$nuevaFicha->setFechaAlta($fechaAlta);

$nuevaFicha->guardar();



header('location: ../listado.php?mensaje=1');

?>


