<?php include_once("encabezado.php"); ?>
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>materias/alta/" method="POST">

    <div class="form-group text-left">
      <label for="clave">Clave:</label>
      <input type="text" name="clave" id="clave" class="form-control" required 
      value="<?php print isset($datos['data']['clave'])?$datos['data']['clave']:'';?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="nombre">* Nombre de la materia:</label>
      <input type="text" name="nombre" id="nombre" class="form-control"
      placeholder="Escribe el nombre de la materia." required  
      value="<?php print isset($datos['data']['nombre'])?$datos['data']['nombre']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="idCarrera">* Carrera:</label>
      <select class="form-control" name="idCarrera" id="idCarrera" 
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
      <option value="void">---Selecciona una carrera---</option>
        <?php
          for ($i=0; $i < count($datos["carreras"]); $i++) { 
            print "<option value='".$datos["carreras"][$i]["id"]."'";
              if(isset($datos["data"]["idCarrera"]) && $datos["data"]["idCarrera"]==$datos["carreras"][$i]["id"]){
                print " selected ";
              }
            print ">".$datos["carreras"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <?php if(isset($datos['data']['temario']) && $datos['data']['temario']!=""){ ?>
    <div class="form-group text-left">
      <label for="temario">* Temario (PDF):</label>
      <input type="text" name="temario" id="temario" class="form-control"
      placeholder="Escribe el nombre del temario."  
      value="<?php print isset($datos['data']['temario'])?$datos['data']['temario']:''; ?>"
      disabled >
    </div>
    <?php } ?>

    <div class="form-group text-left">
      <label for="temarioNuevo">* Nuevo Temario (PDF):</label>
      <input type="file" name="temarioNuevo" id="temarioNuevo" class="form-control"
      placeholder="Seleccione el archivo del temario."   
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>materias/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>materias" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>materias" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
<?php include_once("piepagina.php"); ?>