<?php include_once("encabezado.php"); ?>
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>materiales/alta/" method="POST">

    <div class="form-group text-left">
      <label for="clave">Clave:</label>
      <input type="text" name="clave" id="clave" class="form-control" required 
      value="<?php print isset($datos['data']['clave'])?$datos['data']['clave']:'';?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="tipoMaterial">* Tipo de material:</label>
      <select class="form-control" name="tipoMaterial" id="tipoMaterial" 
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
      <option value="void">---Selecciona un tipo de usuario---</option>
        <?php
          for ($i=0; $i < count($datos["tipoMaterial"]); $i++) { 
            print "<option value='".$datos["tipoMaterial"][$i]["clave"]."'";
              if(isset($datos["data"]["tipoMaterial"]) && $datos["data"]["tipoMaterial"]==$datos["tipoMaterial"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["tipoMaterial"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="descripcion">* Descripción:</label>
      <input type="text" name="descripcion" id="descripcion" class="form-control"
      placeholder="Escribe la descripción del material." required  
      value="<?php print isset($datos['data']['descripcion'])?$datos['data']['descripcion']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="nota">Referenecia:</label>
      <input type="text" name="referencia" id="referencia" class="form-control"
      placeholder="Escribe una referencia sobre el material." required  
      value="<?php print isset($datos['data']['referencia'])?$datos['data']['referencia']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>materiales/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>materiales" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>materiales" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
<?php include_once("piepagina.php"); ?>