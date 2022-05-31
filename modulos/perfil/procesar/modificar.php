<?php

require_once '../../../class/Perfil.php';
require_once '../../../class/PerfilModulo.php';

$idPerfil = $_POST['txtIdPerfil'];
$descripcion = $_POST['txtDescripcion'];
$listaModulos = $_POST['cboModulos'];

//highlight_string(var_export($modulos, true));
//exit;

session_start();

if(empty(trim($descripcion))) {
	$_SESSION['mensaje_error'] = "DESCRIPCION VACIA";
	header("Location: ../modificar.php?id=$idPerfil");
	exit;
}

if ((int) $listaModulos == 0) {
	$_SESSION['mensaje_error'] = "SELECCIONE MODULOS DE ACCESO";
	header("Location: ../modificar.php?id=$idPerfil");
	exit;
}

$perfil = Perfil::obtenerPorId($idPerfil);
$perfil->setDescripcion($descripcion);
$perfil->actualizar();


$perfil->eliminarModulos();

foreach ($listaModulos as $modulo_id) {
	$perfilModulo = new PerfilModulo();
	$perfilModulo->setIdPerfil($perfil->getIdPerfil());
	$perfilModulo->setIdModulo($modulo_id);
	$perfilModulo->guardar();
}

header('location:../listado.php?mensaje=2');

//highlight_string(var_export($perfil, true));


?>