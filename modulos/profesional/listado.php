<?php


require_once '../../class/Profesional.php';
require_once '../../menu.php';
const SIN_ACCION = 0;
const PROFESIONAL_GUARDADO = 1;
const PROFESIONAL_MODIFICADO = 2;
const PROFESIONAL_ELIMINADO = 3;

if (isset($_GET['mensaje'])) {
	$mensaje = $_GET['mensaje'];
} else {
	$mensaje = SIN_ACCION;
}


$listadoProfesionales = Profesional::obtenerTodos();


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<section id="main-content">
		<section class="wrapper">
  		<?php if ($mensaje == PROFESIONAL_GUARDADO){ ?>
  				<h3 align="center"><i class="fa fa-check">Profesional guardado con exito</i></h3>
  		<?php }elseif ($mensaje == PROFESIONAL_MODIFICADO){ ?>
  				<h3 align="center"><i class="fa fa-check">Profesional actualizado con exito</i></h3>
  		<?php }elseif ($mensaje == PROFESIONAL_ELIMINADO){?>
  				<h3 align="center"><i class="fa fa-check">Profesional eliminado con exito</i></h3>
  		<?php } ?>  
        <h3><i class="fa fa-angle-right"></i> Listado Profesionales</h3>
        <a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         Nuevo Profesional</button></a>&nbsp;&nbsp; &nbsp;&nbsp;
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
          Otros
        </button>
        <div class="row mt">
          <div class="col-md-12">
            <div class="content-panel">
              <table class="table table-striped table-advance table-hover">
                <hr>
                <thead>
                  <tr>
                    <th><i class="fa fa-bullhorn"></i> Nombre</th>
                    <th><i class="fa fa-bookmark"></i> Apellido</th>
                    <th><i class=" fa fa-edit"></i> Acciones</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listadoProfesionales as $profesional): ?>
                    <tr>

                      <td><?php echo $profesional->getNombre(); ?> </td>
                      <td> <?php echo $profesional->getApellido(); ?></td>
                      <td>
                      <a href="detalle.php?id=<?php echo $profesional->getIdProfesional(); ?>" title="ver detalle">
                        <button class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                      </a>
                      <a href="modificar.php?id=<?php echo $profesional->getIdProfesional(); ?>" title= "actualizar">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                      </a>
                      <a href="procesar/eliminar.php?id=<?php echo $profesional->getIdProfesional(); ?>" title= "eliminar">
                        <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button>
                      </a>
                      </td>
                    </tr>
                   <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Profesionales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" align="center">
            <a href="../obraSocial/listado.php">
              <button type="button" class="btn btn-primary btn-sm">Ver Obra Sociales</button>
              <br><br>
            <a href="../especialidad/listado.php">
              <button type="button" class="btn btn-primary btn-sm">Ver Especialidades</button>
              </a> </label>
          </div>
        </div>
      </div>
    </div>
</body>
</html>