<?php include_once("encabezado.php"); ?>
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>usuarios/alta/" method="POST">

    <?php 
    if (isset($datos["data"]["foto"]) && $datos["data"]["foto"]!="") {
      if (file_exists("fotos/".$datos["data"]["foto"])) {
        print "<img src='".RUTA."fotos/".$datos["data"]["foto"]."' width='80'/>";
      }
    }
    ?>

    <div class="form-group text-left">
      <label for="tipo">* Tipo de usuario:</label>
      <select class="form-control" name="tipo" id="tipo" 
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
      <option value="void">---Selecciona un tipo de usuario---</option>
        <?php
          for ($i=0; $i < count($datos["tipo"]); $i++) { 
            print "<option value='".$datos["tipo"][$i]["clave"]."'";
              if(isset($datos["data"]["tipo"]) && $datos["data"]["tipo"]==$datos["tipo"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["tipo"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="correo">* Correo:</label>
      <input type="text" name="correo" id="correo" class="form-control" required 
      value="<?php print isset($datos['data']['correo'])?$datos['data']['correo']:'';?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="nombres">* Nombres:</label>
      <input type="text" name="nombres" id="nombres" class="form-control"
      placeholder="Escribe el nombre del usuario." required  
      value="<?php print isset($datos['data']['nombres'])?$datos['data']['nombres']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="apellidoPaterno">* Apellido paterno:</label>
      <input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control"
      placeholder="Escribe el apellido paterno del usuario." required  
      value="<?php print isset($datos['data']['apellidoPaterno'])?$datos['data']['apellidoPaterno']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="apellidoMaterno">Apellido materno:</label>
      <input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control"
      placeholder="Escribe el apellido paterno del usuario."   
      value="<?php print isset($datos['data']['apellidoMaterno'])?$datos['data']['apellidoMaterno']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="genero">* Género:</label>
      <select class="form-control" name="genero" id="genero" 
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
      <option value="void">---Selecciona un género---</option>
        <?php
          for ($i=0; $i < count($datos["genero"]); $i++) { 
            print "<option value='".$datos["genero"][$i]["clave"]."'";
              if(isset($datos["data"]["genero"]) && $datos["data"]["genero"]==$datos["genero"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["genero"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="telefono">Teléfono:</label>
      <input type="text" name="telefono" id="telefono" class="form-control"
      placeholder="Escribe el telefono del usuario."   
      value="<?php print isset($datos['data']['telefono'])?$datos['data']['telefono']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="pais">País:</label>
      <input type="text" name="pais" id="pais" class="form-control"
      placeholder="Escribe el pais del usuario."   
      value="<?php print isset($datos['data']['pais'])?$datos['data']['pais']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="ciudad">Ciudad:</label>
      <input type="text" name="ciudad" id="ciudad" class="form-control"
      placeholder="Escribe la ciudad del usuario."   
      value="<?php print isset($datos['data']['ciudad'])?$datos['data']['ciudad']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="codpos">Código postal:</label>
      <input type="text" name="codpos" id="codpos" class="form-control"
      placeholder="Escribe el código postal del usuario."   
      value="<?php print isset($datos['data']['codpos'])?$datos['data']['codpos']:''; ?>"
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>


    <?php if(isset($datos['data']['foto']) && $datos['data']['foto']!=""){ ?>
    <div class="form-group text-left">
      <label for="foto">* Foto:</label>
      <input type="text" name="foto" id="foto" class="form-control"  
      value="<?php print isset($datos['data']['foto'])?$datos['data']['foto']:''; ?>"
      disabled >
    </div>
    <?php } ?>

    <div class="form-group text-left">
      <label for="fotoNueva">* Nueva foto:</label>
      <input type="file" name="fotoNueva" id="fotoNueva" class="form-control"
      placeholder="Seleccione la foto del usuario."   
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="fechaNacimiento">Fecha nacimiento:</label>
      <input type="date" name="fechaNacimiento" id="fechaNacimiento" class="form-control"
      placeholder="Seleccione la fecha de nacimiento del usuario." 
       value="<?php print isset($datos['data']['fechaNacimiento'])?$datos['data']['fechaNacimiento']:''; ?>"  
      <?php if (isset($datos["baja"])) { print " disabled "; } ?> >
    </div>

    <div class="form-group text-left">
      <label for="tipoSangre">* Tipo de sangre:</label>
      <select class="form-control" name="tipoSangre" id="tipoSangre" 
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
      <option value="void">---Selecciona un tipo de sangre---</option>
        <?php
          for ($i=0; $i < count($datos["tipoSangre"]); $i++) { 
            print "<option value='".$datos["tipoSangre"][$i]["clave"]."'";
              if(isset($datos["data"]["tipoSangre"]) && $datos["data"]["tipoSangre"]==$datos["tipoSangre"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["tipoSangre"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <label for="estado">* Estado del usuario:</label>
      <select class="form-control" name="estado" id="estado" 
      <?php if (isset($datos["baja"])) { print " disabled "; } ?>
      >
      <option value="void">---Selecciona un tipo de usuario---</option>
        <?php
          for ($i=0; $i < count($datos["estado"]); $i++) { 
            print "<option value='".$datos["estado"][$i]["clave"]."'";
              if(isset($datos["data"]["estado"]) && $datos["data"]["estado"]==$datos["estado"][$i]["clave"]){
                print " selected ";
              }
            print ">".$datos["estado"][$i]["descripcion"]."</option>";
          } 
        ?>
      </select>
    </div>

    <div class="form-group text-left">
      <input type="hidden" name="id" id="id" value="<?php if (isset($datos['data']['id'])) { print $datos['data']['id']; } else { print ""; }?>">

      <?php
      if (isset($datos["baja"])) { ?>
        <a href="<?php print RUTA; ?>usuarios/bajaLogica/<?php print $datos['data']['id']; ?>" class="btn btn-danger">Borrar</a>
        <a href="<?php print RUTA; ?>usuarios" class="btn btn-danger">Regresar</a>
        <p><b>Advertencia: una vez borrado el registro, no podrá recuperar la información</b></p>
      <?php } else { ?> 
      <input type="submit" value="Enviar" class="btn btn-success">
      <a href="<?php print RUTA; ?>usuarios" class="btn btn-info">Regresar</a>
    <?php } ?> 
    </div>
  </form>
<?php include_once("piepagina.php"); ?>