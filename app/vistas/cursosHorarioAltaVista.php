<?php include_once("encabezado.php"); ?>
<div class="card p-4 bg-light">
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>cursos/altaHorario/" method="POST">

    <div class="form-group text-left">
      <label for="idSalon">* Salón:</label>
      <select class="form-control" name="idSalon" id="idSalon" 
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <option value="void">---Selecciona un salón---</option>
        <?php
          for ($i=0; $i < count($datos["salones"]); $i++) { 
            print "<option value='".$datos["salones"][$i]["id"]."'";
              if(isset($datos["data"]["idSalon"]) && $datos["data"]["idSalon"]==$datos["salones"][$i]["id"]){
                print " selected ";
              }
            print ">".$datos["salones"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="dia">* Dia:</label>
      <select class="form-control" name="dia" id="dia" 
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <option value="void">---Selecciona un día---</option>
        <?php
          for ($i=0; $i < count($datos["dias"]); $i++) { 
            print "<option value='".$datos["dias"][$i]["clave"]."'";
              if(isset($datos["data"]["dia"]) && $datos["data"]["dia"]==$datos["dias"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["dias"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="horaInicio">* Hora de inicio:</label>
      <input type="time" name="horaInicio" id="horaInicio" class="form-control"
      placeholder="Seleccionar la fecha de inicio del curso."  style="width:250px" 
      value="<?php print isset($datos['data']['horaInicio'])?$datos['data']['horaInicio']:''; ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="horaFin">* Hora final de la clase:</label>
      <input type="time" name="horaFin" id="horaFin" class="form-control" style="width:250px"
      placeholder="Seleccionar la hora del final de la clase."  
      value="<?php print isset($datos['data']['horaFin'])?$datos['data']['horaFin']:''; ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <label for="observacion">Observación:</label>
      <input type="text" name="observacion" id="observacion" class="form-control"
      placeholder="Escriba una observación."  
      value="<?php print isset($datos['data']['observacion'])?$datos['data']['observacion']:''; ?>"
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">
      <input type="hidden" name="idCurso" id="idCurso" value="<?php if (isset($datos['curso']['id'])) { print $datos['curso']['id']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>cursos/bajaLogicaHorario/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>cursos" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>cursos" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>