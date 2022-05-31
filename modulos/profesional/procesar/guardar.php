<?php

require_once '../../../class/Profesional.php';
require_once '../../../class/EspecialidadProfesional.php';
require_once '../../../class/obraSocialProfesional.php';

session_start();

$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$tipoDocumento = $_POST['cboTipoDocumento'];
$numeroDocumento = $_POST['txtNumeroDocumento'];
$matricula = $_POST['txtMatricula'];


if (empty(trim($nombre))) {
	$_SESSION['mensaje_error']= "ERROR NOMBRE VACIO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if (empty(trim($apellido))) {
	$_SESSION['mensaje_error']= "ERROR APELLIDO VACIO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

$listaEspecialidad= $_POST['cboEspecialidad'];

if ($listaEspecialidad == '0'){
	$_SESSION['mensaje_error'] = "DEBE SELECCIONAR LA ESPECIALIDAD";
	header('location:../alta.php');
	exit;
}

$listaObraSocial = $_POST['cboObraSocial'];

if ($listaObraSocial == '0'){
	$_SESSION['mensaje_error'] = "DEBE SELECCIONAR OBRA SOCIAL";
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



if (strlen(trim($numeroDocumento)) < 7){
	$_SESSION['mensaje_error'] = "EL NUMERO DE DOCUMENTO CONTENER 8 CARACTERES";
	header('location:../alta.php');
	exit;
}

function validarMatricula($matricula){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM profesional where matricula = '$matricula'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarMatricula($matricula) == 1){
 	$_SESSION['mensaje_error']= "MATRICULA EXISTENTE";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}


if (empty(trim($matricula))){
	$_SESSION['mensaje_error']= "DEBE INGRESAR SU MATRICULA";
	header('location:../alta.php');

	exit;
}

if (strlen(trim($matricula)) < 3 ) {
	$_SESSION['mensaje_error'] ="LA MATRICULA DEBE TENER 3 CARACTERES";
	header('location:../alta.php');
	exit;
}




$profesional = new Profesional($nombre, $apellido);
$profesional->setFechaNacimiento($fechaNacimiento);
$profesional->setIdTipoDocumento($tipoDocumento);
$profesional->setNumeroDocumento($numeroDocumento);
$profesional->setMatricula($matricula);

$profesional->guardar();

foreach ($listaEspecialidad as $especialidad_id) {
	$especialidadProfesional= new EspecialidadProfesional();
	$especialidadProfesional->setIdProfesional($profesional->getIdProfesional());
	$especialidadProfesional->setIdEspecialidad($especialidad_id);
	$especialidadProfesional->guardar();
}


foreach ($listaObraSocial as $obraSocial_id) {
	$obraSocialProfesional= new obraSocialProfesional();
	$obraSocialProfesional->setIdProfesional($profesional->getIdProfesional());
	$obraSocialProfesional->setIdObraSocial($obraSocial_id);
	$obraSocialProfesional->guardar();
}

header('location:../listado.php?mensaje=1');

?>

