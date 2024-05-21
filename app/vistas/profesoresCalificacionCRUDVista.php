<?php include_once("encabezado.php"); ?>
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>profesores/altaCalificacion/" method="POST">

    <div class="form-group text-left">
      <label for="curso">Curso:</label>
      <input type="text" name="curso" id="curso" class="form-control" disabled 
      value="<?php print $datos['curso']['nombre'];?>" >
    </div>

    <div class="form-group text-left">
      <label for="clase">* Clase:</label>
      <input type="text" name="clase" id="clase" class="form-control" disabled
      value="<?php print $datos['clase']['fecha']." ".$datos['clase']['observacion']; ?>">
    </div>

    <div class="form-group text-left">
      <label for="cali">* Calificación:</label>
      <input type="number" name="cali" id="cali" class="form-control"
      placeholder="Escribe la calificación del alumno." required 
      max="<?php print $datos['clase']['calificacion']; ?>" min="0" 
      value="<?php print isset($datos['cali']['calificacion'])?$datos['cali']['calificacion']:'0'; ?>" >
    </div>

    <div class="form-group text-left">
      <label for="observacion">* Observación:</label>
      <input type="text" name="observacion" id="observacion" class="form-control"
      placeholder="Escribe la observación de la calificación." 
      value="<?php print isset($datos['cali']['observacion'])?$datos['cali']['observacion']:''; ?>">
    </div>


    <div class="form-group text-left">
      <input type="hidden" name="idClase" id="idClase" value="<?php if (isset($datos['clase']['id'])) { print $datos['clase']['id']; } else { print ""; }?>">
      <input type="hidden" name="idEstudiante" id="idEstudiante" value="<?php if (isset($datos['usuario']['id'])) { print $datos['usuario']['id']; } else { print ""; }?>">
      <input type="hidden" name="idCali" id="idCali" value="<?php if (isset($datos['cali']['id'])) { print $datos['cali']['id']; } else { print ""; }?>">
      <input type="hidden" name="idCurso" id="idCurso" value="<?php if (isset($datos['curso']['id'])) { print $datos['curso']['id']; } else { print ""; }?>">
      <input type="hidden" name="max" id="max" value="<?php print $datos['clase']['calificacion'];?>">


      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA.'profesores/calificacionEstudiante/'.$datos['usuario']['id'].'/'.$datos['curso']['id'];?>" class="btn btn-info">Regresar</a>
    </div>
  </form>
<?php include_once("piepagina.php"); ?>