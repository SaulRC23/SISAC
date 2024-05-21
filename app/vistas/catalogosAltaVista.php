<?php include_once("encabezado.php"); ?>
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>catalogos/alta/" method="POST">

    <div class="form-group text-left">
      <label for="clave">Clave:</label>
      <input type="text" name="clave" id="clave" class="form-control" disabled
      value="<?php print isset($datos['data']['clave'])?$datos['data']['clave']:'';?>">
    </div>

    <div class="form-group text-left">
      <label for="tipo">Tipo:</label>
      <input type="text" name="tipo" id="tipo" class="form-control" disabled  
      value="<?php print isset($datos['data']['tipo'])?$datos['data']['tipo']:''; ?>">
    </div>

    <div class="form-group text-left">
      <label for="descripcion">* Descripción:</label>
      <input type="text" name="descripcion" id="descripcion" class="form-control"
      placeholder="Escribe la descripción de la llave del catálogo." required 
      value="<?php 
      print isset($datos['data']['descripcion'])?$datos['data']['descripcion']:''; 
      ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">
      <input type="hidden" name="clave2" id="clave2" value="<?php if (isset($datos['data']['clave'])) { print $datos['data']['clave']; } else { print ""; }?>">
      <input type="hidden" name="tipo2" id="tipo2" value="<?php if (isset($datos['data']['tipo'])) { print $datos['data']['tipo']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>catalogos/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>catalogos" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>catalogos" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
<?php include_once("piepagina.php"); ?>