<?php

require_once '../../class/Usuario.php';
require_once "../../menu.php";

const SIN_ACCION = 0;
const USUARIO_GUARDADO = 1;
const USUARIO_MODIFICADO = 2;
const USUARIO_ELIMINADO = 3;

if (isset($_GET['mensaje'])) {
  $mensaje = $_GET['mensaje'];
} else {
  $mensaje = SIN_ACCION;
}

$listaUsuarios= Usuario::ObtenerTodos();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Listado Usuarios</title>

</head>
<body>
	<section id="main-content">
		<section class="wrapper">
        <?php if ($mensaje == USUARIO_GUARDADO){ ?>
          <h3 align="center"><i class="fa fa-check">Usuario guardado con exito</i></h3>
        <?php }elseif ($mensaje == USUARIO_MODIFICADO){ ?>
            <h3 align="center"><i class="fa fa-check">Usuario actualizado con exito</i></h3>
        <?php }elseif ($mensaje == USUARIO_ELIMINADO){ ?>
            <h3 align="center"><i class="fa fa-check">Usuario eliminado con exito</i></h3> 
        <?php } ?>
		    <h3><i class="fa fa-angle-right"></i> Listado Usuarios</h3>
        <a href="alta.php"><button type="button" class="btn btn-primary btn-sm">
         Nuevo Usuario</button></a>
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
                	 <?php foreach ($listaUsuarios as $usuario): ?>
                  <tr>

                      <td><?php echo $usuario->getNombre(); ?> </td>
                      <td> <?php echo $usuario->getApellido(); ?></td>
                      <td>
                      <a href="detalle.php?id=<?php echo $usuario->getIdUsuario(); ?>" title="ver detalle">
                        <button class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>
                      </a>
                      <a href="modificar.php?id=<?php echo $usuario->getIdUsuario(); ?>" title= "actualizar">
                        <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                      </a>
                      <a href="procesar/eliminar.php?id=<?php echo $usuario->getIdUsuario(); ?>" title= "eliminar">
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
</body>
</html>


   