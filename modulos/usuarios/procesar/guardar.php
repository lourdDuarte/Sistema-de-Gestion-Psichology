<?php

require_once "../../../class/Usuario.php";
require_once "../../../class/MySQL.php";

session_start();

$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$username = $_POST ['txtUsername'];
$password = $_POST ['txtPassword'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$tipoDocumento = $_POST['cboTipoDocumento'];
$perfil = $_POST['cboTipoPerfil'];
$numeroDocumento = $_POST['txtNumeroDocumento'];




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


if ($perfil == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR TIPO DE PERFIL";
	header('location:../alta.php');
	exit;
}



if (empty(trim($username))) {
	$_SESSION['mensaje_error']= "DEBE INGRESAR NOMBRE DE USUARIO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

//usuario existente en base de datos

function validarUsuario($usuario){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM usuario where username = '$usuario'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarUsuario($username) == 1){
 	$_SESSION['mensaje_error']= "NOMBRE DE USUARIO OCUPADO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

	

if (empty(trim($password))) {
	$_SESSION['mensaje_error']= "ERROR CONTRASEÑA VACIA";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if (strlen(trim($password)) < 6){
	$_SESSION['mensaje_error'] = "CONTRASEÑA INSEGURA:ingrese al menos 6 caracteres";
	header('location:../alta.php');
	exit;
}


if (empty(trim($numeroDocumento))){
	$_SESSION['mensaje_error'] = "DEBE INGRESAR NUMERO DE DOCUMENTO";
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


if (empty(trim($fechaNacimiento))) {
	$_SESSION['mensaje_error']= "DEBE INGRESAR FECHA DE NACIMIENTO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
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


 



$usuario = new Usuario($nombre, $apellido);
$usuario->setUsername($username);
$usuario->setPassword($password);
$usuario->setFechaNacimiento($fechaNacimiento);
$usuario->setIdTipoDocumento($tipoDocumento);
$usuario->setIdPerfil($perfil);
$usuario->setNumeroDocumento($numeroDocumento);


$usuario->guardar();

//highlight_string(var_export($paciente,true));

header('location:../listado.php?mensaje=1');

?>















