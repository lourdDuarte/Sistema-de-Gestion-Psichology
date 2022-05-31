<?

require_once '../../class/Barrio.php';
require_once "../../menu.php";

const SIN_ACCION = 0;
const BARRIO_GUARDADO = 1;
const BARRIO_MODIFICADO = 2;


if(isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
}else {
	$mensaje = SIN_ACCION;
}

$listadoBarrios = Barrio::obtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<section id="main-content">
		<section class="wrapper">
			<?php if ($mensaje == BARRIO_GUARDADO){ ?>
		  		<h3 align="center"><i class="fa fa-check">Barrio guardado con exito</i></h3>
			<?php }elseif ($mensaje == BARRIO_MODIFICADO){ ?>
			  <h3 align="center"><i class="fa fa-check">Barrio modificado con exito</i></h3>
			<?php } ?>
			<h3><i class="fa fa-angle-right"></i> Barrios</h3>
			<a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         	Nueva Barrio</button></a>
			<div class="row mt">
          		<div class="col-md-12">
            		<div class="content-panel">
              			<table class="table table-striped table-advance table-hover">
	                		<hr>
	                		<thead>
	                  			<tr>
									<th><i class="fa fa-bullhorn"></i>Nombre</th>
									<th><i class="fa fa-bullhorn"></i>Acciones</th>
								</tr>
	                		</thead>
	                		<?php foreach ($listadoBarrios as $barrio):?>
	                		<tbody>
	                			
	                				<td> <?php echo $barrio->getDescripcion(); ?> </td>
	                				<td>
	                					<a href="modificar.php?id=<?php echo $barrio->getIdBarrio(); ?>"title= "actualizar">
			                      		<button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
										</a>
	                				</td>
	                			
	                		</tbody>
	                		<?php endforeach ?>
	                	</table>
	                </div>
	            </div>
	        </div>

		</section>
	</section>

</body>
</html>