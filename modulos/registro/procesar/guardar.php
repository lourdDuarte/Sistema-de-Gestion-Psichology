
<?php
require_once "../../../class/Usuario.php";
require_once "../../../class/MySQL.php";


session_start();


$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$username = $_POST ['txtUsername'];
$password = $_POST ['txtPassword'];
$perfil = $_POST['cboTipoPerfil'];

if (empty(trim($nombre))) {
	header('location:../registro.php?mensaje=NOMBRE VACIO');
	echo "ERROR NOMBRE VACIO";
	exit;
}
if (empty(trim($apellido))) {
	header('location:../registro.php?mensaje=APELLIDO VACIO');;
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if ($perfil == '0'){
	header('location:../registro.php?mensaje=SELECCIONE UN PERFIL');
	exit;
}


if (empty(trim($username))) {
	header('location:../registro.php?mensaje=USUARIO VACIO');
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
     header('location:../registro.php?mensaje=USUARIO YA EXISTENTE');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

	

if (empty(trim($password))) {
	header('location:../registro.php?mensaje=CONTRASEÑA VACIA');;
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if (strlen(trim($password)) < 6){
	header('location:../registro.php?mensaje= INGRESE AL MENOS 6 CARACTERES DE CONTRASEÑA');
	exit;
}



$usuario = new Usuario($nombre, $apellido);
$usuario->setUsername($username);
$usuario->setPassword($password);
$usuario->setIdTipoDocumento($tipoDocumento);
$usuario->setIdPerfil($perfil);
$usuario->setNumeroDocumento($numeroDocumento);


$usuario->guardar();


//highlight_string(var_export($usuario,true));

header('location:../../../formulario_login.php?mensaje=1');


?>