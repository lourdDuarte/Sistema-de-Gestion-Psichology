<?php

require_once '../../../class/Perfil.php';
require_once '../../../class/PerfilModulo.php';
require_once '../../../class/MySQL.php';

session_start();

$descripcion = $_POST['txtDescripcion'];
$listaModulos = $_POST['cboModulos'];

//highlight_string(var_export($modulos, true));
//exit;

if(empty(trim($descripcion))) {
	$_SESSION['mensaje_error'] = "DESCRIPCION VACIA";
	header("location: ../alta.php");
	exit;
}

if ((int) $listaModulos == 0) {
	$_SESSION['mensaje_error'] = "SELECCIONE MODULOS DE ACCESO";
	header("location: ../alta.php");
	exit;
}

function validarPerfil($descripcion){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM perfil WHERE descripcion = '$descripcion'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarPerfil($descripcion) == 1){
 	$_SESSION['mensaje_error']= "DESCRIPCION YA REGISTRADA ";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}


$perfil = new Perfil($descripcion);
$perfil->guardar();


foreach ($listaModulos as $modulo_id) {
	$perfilModulo = new PerfilModulo();
	$perfilModulo->setIdPerfil($perfil->getIdPerfil());
	$perfilModulo->setIdModulo($modulo_id);
	$perfilModulo->guardar();
}

//highlight_string(var_export($perfil, true));

header('location:../listado.php?mensaje=1');
?>