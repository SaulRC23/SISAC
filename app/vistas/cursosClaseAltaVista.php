<?php include_once("encabezado.php"); ?>
<div class="card p-4 bg-light">
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>cursos/altaClase/" method="POST">

    <div class="form-group text-left">
      <label for="fecha">* Fecha de la clase:</label>
      <input type="date" name="fecha" id="fecha" class="form-control" style="width:250px"   disabled 
      value="<?php print isset($datos['data']['fecha'])?$datos['data']['fecha']:''; ?>"
      >
    </div>

    <div class="form-group text-left">
      <label for="tipo">* Tipo:</label>
      <select class="form-control" name="tipo" id="tipo" 
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <option value="void">---Selecciona un tipo de examen---</option>
        <?php
          for ($i=0; $i < count($datos["tipoExamen"]); $i++) { 
            print "<option value='".$datos["tipoExamen"][$i]["clave"]."'";
              if(isset($datos["data"]["tipoExamen"]) && $datos["data"]["tipoExamen"]==$datos["tipoExamen"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["tipoExamen"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="calificacion">* Calificación:</label>
      <input type="text" name="calificacion" id="calificacion" class="form-control"
      placeholder="Seleccionar la calificacion máxima del examen." 
      value="<?php print isset($datos['data']['calificacion'])?$datos['data']['calificacion']:''; ?>" <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="observacion">Observación:</label>
      <input type="text" name="observacion" id="observacion" class="form-control"
      placeholder="Escriba una observación."  
      value="<?php print isset($datos['data']['observacion'])?$datos['data']['observacion']:''; ?>" <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">
      <input type="hidden" name="idCurso" id="idCurso" value="<?php if (isset($datos['curso']['id'])) { print $datos['curso']['id']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>cursos/bajaLogicaExamen/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>cursos" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA.'cursos/horario/'.$datos['curso']['id']; ?>" class="btn btn-success">Regresar</a>
    <?php } ?> 
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>