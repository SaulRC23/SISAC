<?php include("encabezado.php"); ?>
<div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id</th>
    <th>Apellido paterno</th>
    <th>Apellido materno</th>
    <th>Nombres</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]['id']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["apellidoPaterno"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["apellidoMaterno"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]['nombres']."</td>";
      print "<td><a href='".RUTA."profesores/asistenciaEstudiante/".$datos["data"][$i]["id"]."/".$datos["curso"]["id"]."' class='btn btn-warning'>Asistencia</a></td>";
      print "<td><a href='".RUTA."profesores/desinscribirEstudiante/".$datos["data"][$i]["id"]."/".$datos["curso"]["id"]."' class='btn btn-warning'>Desinscribir</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  <?php include("paginacion.php"); ?>
  </div>
<a href="<?php print RUTA; ?>profesores" class="btn btn-success">
  Regresar</a>
<?php include_once("piepagina.php"); ?>