<?php

require_once '../../../class/Modulo.php';
require_once '../../../class/MySQL.php';

$descripcion = $_POST['txtDescripcion'];
$directorio = $_POST['txtDirectorio'];

session_start();
//validaciones
if (empty(trim($descripcion))) {
    $_SESSION['mensaje_error']= "DEBE DETERMINAR EL NOMBRE DEL MODULO";
    header('location:../alta.php');
    
    exit;
}

function validarDescripcion($descripcion){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM modulo WHERE descripcion = '$descripcion' ";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarDescripcion($descripcion) == 1){
 	$_SESSION['mensaje_error']= "Nombre para el modulo ocupado, elija otro";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if (empty(trim($directorio))) {
    $_SESSION['mensaje_error']= "DEBE DETERMINAR EL DIRECTORIO";
    header('location:../alta.php');
    
    exit;
}

function validarDirectorio($directorio){
 	$mysql = new MySQL();

 	$sql = "SELECT * FROM modulo WHERE directorio = '$directorio' ";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarDirectorio($directorio) == 1){
 	$_SESSION['mensaje_error']= "Ingreso un directorio ya existente";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}


$modulo = new Modulo($descripcion, $directorio);

$modulo->guardar();

header("location:../listado.php?mensaje=1");


?>