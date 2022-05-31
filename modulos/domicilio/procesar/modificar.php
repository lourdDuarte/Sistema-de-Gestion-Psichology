
<?php
require_once "../../../class/Domicilio.php";;

$idDomicilio = $_POST['txtDomicilio'];
$idPersona = $_POST['txtIdPersona'];
$idLlamada = $_POST['txtIdLlamada'];
$modulo = $_POST['txtModulo'];
$calle = $_POST['txtCalle'];
$altura = $_POST['txtAltura'];
$piso = $_POST['txtPiso'];
$manzana = $_POST['txtManzana'];
$idBarrio = $_POST['cboBarrio'];

$domicilio=Domicilio::obtenerPorIdPersona($idPersona);
$domicilio->setCalle($calle);
$domicilio->setAltura($altura);
$domicilio->setPiso($piso);
$domicilio->setManzana($manzana);
$domicilio->setIdBarrio($idBarrio);

$domicilio->actualizar();

header("location: /programacion3/gestion/modulos/$modulo/detalle.php?id=$idLlamada");

?>