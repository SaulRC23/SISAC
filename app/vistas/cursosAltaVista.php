<?php include_once("encabezado.php"); ?>
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>cursos/alta/" method="POST">

    <div class="form-group text-left">
      <label for="clave">Clave:</label>
      <input type="text" name="clave" id="clave" class="form-control" required 
      value="<?php print isset($datos['data']['clave'])?$datos['data']['clave']:'';?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="idMateria">* Materia:</label>
      <select class="form-control" name="idMateria" id="idMateria" 
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <option value="void">---Selecciona una materia---</option>
        <?php
          for ($i=0; $i < count($datos["materias"]); $i++) { 
            print "<option value='".$datos["materias"][$i]["id"]."'";
              if(isset($datos["data"]["idMateria"]) && $datos["data"]["idMateria"]==$datos["materias"][$i]["id"]){
                print " selected ";
              }
            print ">".$datos["materias"][$i]["nombre"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="nombre">* Nombre de la materia:</label>
      <input type="text" name="nombre" id="nombre" class="form-control"
      placeholder="Escribe la nombre del curso." required  
      value="<?php print isset($datos['data']['nombre'])?$datos['data']['nombre']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <?php
      if (isset($datos["data"]["temario"]) && !empty($datos["data"]["temario"])) {
        print '<div class="form-group text-left">';
        print '<label for="Temario">Temario seleccionado:</label>';
        print '<input type="text" class="form-control" value="'.$datos["data"]["temario"];
        print '" disabled></div>';
      }
    ?>

    <?php if (!isset($datos["baja"])){ ?>
    <div class="form-group text-left">
      <label for="Temario">Temario:</label>
      <input type="file" name="temarioNuevo" id="temarioNuevo" class="form-control"
      placeholder="Selecciona el temario del curso." 
      accept="application/pdf" 
      value=""
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
    </div>
    <?php } ?>

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
      <label for="idProfesor">* Profesor:</label>
      <select class="form-control" name="idProfesor" id="idProfesor" 
      <?php
      if (isset($datos["baja"])) {
        print " disabled ";
      }
      ?>
      >
      <option value="void">---Selecciona un profesor---</option>
        <?php
          for ($i=0; $i < count($datos["profesores"]); $i++) { 
            print "<option value='".$datos["profesores"][$i]["id"]."'";
              if(isset($datos["data"]["idProfesor"]) && $datos["data"]["idProfesor"]==$datos["profesores"][$i]["id"]){
                print " selected ";
              }
            print ">".$datos["profesores"][$i]["nombres"]." ".$datos["profesores"][$i]["apellidoPaterno"]." ".$datos["profesores"][$i]["apellidoMaterno"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="fechaInicio">* Fecha de inicio:</label>
      <input type="date" name="fechaInicio" id="fechaInicio" class="form-control"
      placeholder="Seleccionar la fecha de inicio del curso."  style="width:250px" 
      value="<?php print isset($datos['data']['fechaInicio'])?$datos['data']['fechaInicio']:''; ?>" <?php if (isset($datos["baja"])) { print " disabled "; } ?>>
    </div>

    <div class="form-group text-left">
      <label for="fechaFin">* Fecha de final del curso:</label>
      <input type="date" name="fechaFin" id="fechaFin" class="form-control" style="width:250px"
      placeholder="Seleccionar la fecha de final del curso."  
      value="<?php print isset($datos['data']['fechaFin'])?$datos['data']['fechaFin']:''; ?>" <?php if (isset($datos["baja"])) { print " disabled "; } ?>>
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">
      <input type="hidden" name="temario" id="temario" value="<?php if (isset($datos['data']['temario'])) { print $datos['data']['temario']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>cursos/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>cursos" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>cursos" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
<?php include_once("piepagina.php"); ?>