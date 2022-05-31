<?php 

require_once '../../menu.php';
require_once '../../class/PagoOs.php';
require_once '../../class/EstadoPago.php';
require_once '../../class/Paciente.php';

const SIN_ACCION = 0;
const PAGO_AGREGADO = 1;
const PAGO_ACTUALIZADO = 2;

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
} else {
	$mensaje = SIN_ACCION;
}

$listadoPagos = PagoOs::obtenerTodos();
$listaPaciente = Paciente::obtenerTodos();

foreach($listadoPagos as $pago){
	if($pago->getMontoSesion() == $pago->getTotal()){
	$pago->setIdEstado(1);
}elseif($pago->getMontoSesion() != $pago->getTotal()){
	$pago->setIdEstado(2);

}
$pago->actualizarEstado();
}




?>


<html>
<head>
	<title>Listado Pagos</title>
</head>
<body>
<section id="main-content">
    <section class="wrapper">
      	<?php if ($mensaje == PAGO_AGREGADO){ ?>
				<h3 align="center"><i class="fa fa-check">Pago guardado con exito</i></h3>
				
		<?php }elseif ($mensaje == PAGO_ACTUALIZADO){ ?>
				<h3 align="center"><i class="fa fa-check">Pago actualizado con exito</i></h3>
		<?php } ?>

        <h3><i class="fa fa-angle-right"></i> Registro de Pagos</h3>
        <a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         Nuevo Pago</button></a>&nbsp;&nbsp; &nbsp;&nbsp;
        <a href="informe/informeDeEstadoPago.php">
			<button type="button" class="btn btn-primary btn-sm">Informe Registros</button>
 		</a>
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
	                <hr>
	                	<thead>
	                		<tr>
								<th>Paciente</th>
								<th>Fecha</th>
								<th>Sesiones Autorizadas</th>
								<th>Sesiones Abonadas</th>
								<th>Monto Actual</th>
								<th>Total</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($listadoPagos as $pago):?>
								<tr>
									<?php foreach ($listaPaciente as $paciente):?>
										<?php if ($pago->getIdPaciente() == $paciente->getIdPaciente()):?>
											<td><?php echo $paciente?></td>
										<?php endif?>
									<?php endforeach?>

									<td><?php echo $pago->getFecha();?></td>
									<td><?php echo $pago->getSesionesAutorizadas();?></td>
									<td><?php echo $pago->getSesionesAbonada();?></td>
									<td><?php echo "$"."". $pago->getMontoSesion();?></td>
									<td><?php echo "$"."". $pago->getTotal();?></td>
								
									<?php if($pago->getIdEstado() == 1): ?>
										<td>
										<i class="btn btn-success">
										Pago Completo</i></td></button>
									<?php endif ?>
									<?php if ($pago->getIdEstado() == 2): ?>
										<td>
											<i class="btn btn-danger">Pago Incompleto</td></button>
									<?php endif?>
									<td>
									
									<a href="modificar.php?idPago=<?php echo $pago->getIdPago();?>" title="modificar">
									<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
									</a>
									</td>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</section>
</section>
</body>
</html>

