<?php

require_once '../../../class/Usuario.php';

$id = $_POST['txtId'];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$username = $_POST['txtUsername'];
$password = $_POST['txtPassword'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$tipoDocumento = $_POST['cboTipoDocumento'];
$numeroDocumento = $_POST['txtNumeroDocumento'];

session_start();

if (empty(trim($nombre))) {
	$_SESSION['mensaje_error']= "ERROR NOMBRE VACIO";
	header("Location: ../modificar.php?id=$id");
	//echo "ERROR NOMBRE VACIO";
	exit;
}
if (empty(trim($apellido))) {
	$_SESSION['mensaje_error']= "ERROR APELLIDO VACIO";
	header("Location: ../modificar.php?id=$id");
	//echo "ERROR NOMBRE VACIO";
	exit;
}


if ($perfil == '0'){
	$_SESSION['mensaje_error'] = "DEBE ESPECIFICAR TIPO DE PERFIL";
	header("Location: ../modificar.php?id=$id");
	exit;
}



if (empty(trim($username))) {
	$_SESSION['mensaje_error']= "DEBE INGRESAR NOMBRE DE USUARIO";
	header("Location: ../modificar.php?id=$id");
	//echo "ERROR NOMBRE VACIO";
	exit;
}


if (empty(trim($password))) {
	$_SESSION['mensaje_error']= "ERROR CONTRASEÑA VACIA";
	header("Location: ../modificar.php?id=$id");
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if (strlen(trim($password)) < 6){
	$_SESSION['mensaje_error'] = "CONTRASEÑA INSEGURA:ingrese al menos 6 caracteres";
	header("Location: ../modificar.php?id=$id");
	exit;
}


if (empty(trim($numeroDocumento))){
	$_SESSION['mensaje_error'] = "DEBE INGRESAR NUMERO DE DOCUMENTO";
	header("Location: ../modificar.php?id=$id");
	exit;
}



if (empty(trim($fechaNacimiento))) {
	$_SESSION['mensaje_error']= "DEBE INGRESAR FECHA DE NACIMIENTO";
	header("Location: ../modificar.php?id=$id");
	//echo "ERROR NOMBRE VACIO";
	exit;
}


//validacion de error en fecha 
date_default_timezone_set('America/Argentina/Buenos_Aires');

$fechaActual= date("Y-m-d");

if ($fechaNacimiento >= $fechaActual ) {
    $_SESSION['mensaje_error'] = "LA FECHA INGRESADA NO ES VALIDA";
	header("Location: ../modificar.php?id=$id");
	exit;
}



$usuario = Usuario::ObtenerPorId($id);
$usuario->setNombre($nombre);
$usuario->setApellido($apellido);
$usuario->setUsername($username);
$usuario->setPassword($password);
$usuario->setFechaNacimiento($fechaNacimiento);
$usuario->setIdTipoDocumento($tipoDocumento);
$usuario->setNumeroDocumento($numeroDocumento);

$usuario->actualizar();

//highlight_string(var_export($usuario,true));

header('location:../listado.php?mensaje=2');

?>


