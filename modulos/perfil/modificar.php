<?php

require_once '../../class/Perfil.php';
require_once '../../class/Modulo.php';
require_once '../../menu.php';

$id= $_GET['id'];

$perfil=Perfil::obtenerPorId($id);

$listadoModulos=Modulo::obtenerTodos();


?>


<!DOCTYPE html>
<html>
<head>
  <title>Actualizar Perfil</title>
</head>
<body>
  <section id="main-content">
    <section class="wrapper">
      <div align="center">
            <?php if (isset($_SESSION['mensaje_error'])) : ?>
                <font color="red">
                    <h3><?php echo $_SESSION['mensaje_error'] ?></h3>
                </font>
            <?php
                    unset($_SESSION['mensaje_error']);
                endif;
            ?>            
          <div id="mensajeError"></div>
        </div>
      <div class="row mt">
        <div class="col-lg-12">
          <h4><i class="fa fa-angle-right"></i> Actualizar Pefil</h4>
          <div class="form-panel">
            <div class=" form">
              <br>
              <form class="cmxform form-horizontal style-form" id="commentForm" name="frmDatos" method="POST" action = "procesar/modificar.php">
         	      <input type="hidden" name="txtIdPerfil" value="<?php echo $perfil->getIdPerfil(); ?>">

                <div class="row mt">
                  <label class="col-lg-2 control-label">Descripcion:</label>
                  <div class="col-lg-10">
                    <input type="text" name="txtDescripcion" id= "txtDescripcion" value="<?php echo $perfil->getDescripcion();?>" class="form-control">
                  </div>
                </div>
                <div class="row mt">
                  <label class="col-lg-2 control-label">Modulos: </label>
                  <div class="col-lg-10">
                    <select name="cboModulos[]" multiple style="width: 150px; height: 150px;">

          		         <?php foreach ($listadoModulos as $modulo) :?>

          		         	<?php

          		         	$selected = '';
          		         	$idModulo = $modulo->getIdModulo();

          		         	if ($perfil->tieneModulo($idModulo)) {
          		         		$selected = "SELECTED";
          		         	}

          		         	?>

          		         	<option value="<?php echo $modulo->getIdModulo(); ?>" <?php echo $selected ?> >
          		         		<?php echo $modulo ?>
          		         	</option>

          		         <?php endforeach ?>
		                </select>
                  </div>
                </div>
                <div align="left">                
                  <div class="row mt">
                    <div class="col-lg-offset-2 col-lg-10">
                      <input type="submit" name="btnGuardar" value="Actualizar">
                    </div>
                   </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</body>
</html>