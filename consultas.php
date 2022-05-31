<?php

require_once 'class/MySQL.php';



function pacientesEnElMesPorAño(){
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$añoActual = date("Y");
	$mesActual = date("n");
	
	$sql = " SELECT MONTHNAME(Fecha) as mes,count(id_paciente) as total from turno "
		 . " WHERE YEAR(fecha) = '$añoActual' group by MONTH(Fecha) ";

	$mysql = new MySQL();
	$datos = $mysql->consultar($sql);
	$mysql->desconectar();

	$listado = array();
    while($r = mysqli_fetch_assoc($datos)) {
        $listado[] = $r;
    }
	return $listado;
}

function estadoTurnosPorMes(){
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$añoActual = date("Y");
	$mesActual = date("n");

	$sql = " SELECT count(turno.id_estado) as estado, estadoturno.descripcion as DESCRIPCION "
	      . " FROM turno inner join estadoturno "
	      . " ON turno.id_estado = estadoturno.id_estado WHERE MONTH(fecha) = '$mesActual' group by estadoturno.descripcion ";
	$mysql = new MySQL();
	$datos = $mysql->consultar($sql);
	$mysql->desconectar();

	$listado = array();
    while($r = mysqli_fetch_assoc($datos)) {
        $listado[] = $r;
    }
	return $listado;

}

function pagosCompletosDelMes(){
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$añoActual = date("Y");
	$mesActual = date("n");

	$sql = " SELECT count(pagoOs.id_estado) as estadoCompleto from pagoOs "
	      . " inner join estadopago on estadopago.id_estado = pagoOs.id_estado "
	      . " where pagoOs.id_estado = 1 AND MONTH(pagoOs.fecha) = '$mesActual' ";

	$mysql = new MySQL();
	$datos = $mysql->consultar($sql);
	$mysql->desconectar();
	$listado = array();
    while($r = mysqli_fetch_assoc($datos)) {
        $listado[] = $r;
    }
	return $listado;

}

function agendasCreadasPorMes(){
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$añoActual = date("Y");
	$mesActual = date("n");

	$sql = " SELECT count(id_agenda) AS totalAgendas from agenda where MONTH(fecha_desde) = '$mesActual';";

	$mysql = new MySQL();
	$datos = $mysql->consultar($sql);
	$mysql->desconectar();

	$listado = array();
    while($r = mysqli_fetch_assoc($datos)) {
        $listado[] = $r;
    }
	return $listado;

}

function pacientesIngresadosPorMes(){
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$añoActual = date("Y");
	$mesActual = date("n");

	$sql = "SELECT count(fecha_alta) as total from ficha where MONTH(fecha_alta) = '$mesActual';";

	$mysql = new MySQL();
	$datos = $mysql->consultar($sql);
	$mysql->desconectar();

	$listado = array();
    while($r = mysqli_fetch_assoc($datos)) {
        $listado[] = $r;
    }
	return $listado;

}

?>