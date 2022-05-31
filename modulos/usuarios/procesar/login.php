<?php

require_once "../../../class/Usuario.php";


$username = $_POST['txtUsuario'];
$password = $_POST['txtPassword'];


$usuario = Usuario::login($username, $password);

if ($usuario->estaLogueado()) {
	session_start();
	$_SESSION['usuario'] = $usuario;
	if($usuario->perfil->getIdPerfil() == 1){
		header("location: ../../dashboard/listado.php");
	} elseif ($usuario->perfil->getIdPerfil() == 2){
		header("location: ../../dashboard/inicio.php");
	}
} else {
	header("location: ../../../formulario_login.php");
}


?>