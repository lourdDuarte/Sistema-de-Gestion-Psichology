<?php

require_once "../../../class/Usuario.php";

$id=$_GET['id'];

$usuario= Usuario::ObtenerPorId($id);

$usuario->getIdUsuario();
$usuario->getIdPersona();
$usuario->getNombre();
$usuario->getApellido();
$usuario->getPassword();
$usuario->getUsername();
$usuario->getFechaNacimiento();
$usuario->getIdTipoDocumento();
$usuario->getNumeroDocumento();
$usuario->getEstado();

$usuario->eliminar();

header('location:../listado.php);

?>

