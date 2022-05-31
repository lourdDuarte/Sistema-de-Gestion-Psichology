<?php

require_once '../../../class/Contacto.php';
require_once '../../../class/MySQL.php';

$idPersona = $_POST['txtIdPersona'];
$idLlamada = $_POST['txtIdLlamada'];
$modulo = $_POST['txtModulo'];
$valor = $_POST['txtValor'];
$idTipoContacto = $_POST['cboTipoContacto'];


session_start();

if (empty(trim($valor))){
	$_SESSION['mensaje_error']="DEBE INGRESAR EL VALOR";
	header("location:../alta.php");
	exit;
}

function validarValor($valor){
 	$mysql = new MySQL();

 	$sql = " SELECT * FROM persona_contacto WHERE valor = '$valor'";

 	$result = $mysql->consultar($sql);
 	if(mysqli_num_rows($result) > 0 ){
 		return 1;
 	}
}

 if(validarValor($valor) == 1){
 	$_SESSION['mensaje_error']= "ESTE VALOR YA ESTA REGISTRADO";
	header('location:../alta.php');
	//echo "ERROR NOMBRE VACIO";
	exit;
}

if($idTipoContacto == '0'){
	$_SESSION['mensaje_error']="DEBE DEFINIR EL TIPO";
	header("location:../alta.php");
	exit;
}


$contacto= New Contacto;
$contacto->setIdPersona($idPersona);
$contacto->setIdTipoContacto($idTipoContacto);
$contacto->setValor($valor);

$contacto->guardar();

//highlight_string(var_export($contacto,true));

header("location:/programacion3/Gestion/modulos/$modulo/detalle.php?id=$idLlamada");

?>