<?php

require_once '../../../class/Profesional.php';
require_once '../../../class/EspecialidadProfesional.php';
require_once '../../../class/obraSocialProfesional.php';

$id= $_POST['txtId'];
$nombre = $_POST['txtNombre'];
$apellido = $_POST['txtApellido'];
$fechaNacimiento = $_POST['txtFechaNacimiento'];
$tipoDocumento = $_POST['cboTipoDocumento'];
$numeroDocumento = $_POST['txtNumeroDocumento'];
$matricula = $_POST['txtMatricula'];
$listaEspecialidad = $_POST['cboEspecialidad'];
$listaObraSocial = $_POST ['cboObraSocial'];


if (empty(trim($nombre))) {
	echo "ERROR NOMBRE VACIO";
	exit;
}


$profesional = Profesional::ObtenerPorId($id);
$profesional->setNombre($nombre);
$profesional->setApellido($apellido);
$profesional->setFechaNacimiento($fechaNacimiento);
$profesional->setIdTipoDocumento($tipoDocumento);
$profesional->setNumeroDocumento($numeroDocumento);
$profesional->setMatricula($matricula);

$profesional->actualizar();

//highlight_string(var_export($profesional,true));

//UPDATE ESPECIALIDAD 

$profesional->eliminarEspecialidad();

foreach ($listaEspecialidad as $especialidad_id) {
	$especialidadProfesional = new EspecialidadProfesional();
	$especialidadProfesional->setIdProfesional($profesional->getIdProfesional());
	$especialidadProfesional->setIdEspecialidad($especialidad_id);
	$especialidadProfesional->guardar();
}

//UPDATE OBRA SOCIAL
$profesional->eliminarObraSocial();

foreach ($listaObraSocial as $obraSocial_id){
	$obraSocialProfesional = new obraSocialProfesional();
	$obraSocialProfesional->setIdProfesional($profesional->getIdProfesional());
	$obraSocialProfesional->setIdObraSocial($obraSocial_id);
	$obraSocialProfesional->guardar(); 
}
header('location:../listado.php?mensaje=2');

?>
