<?php include_once("encabezado.php"); ?>
  <div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>id</th>
    <th>Apellido paterno</th>
    <th>Apellido materno</th>
    <th>Nombres</th>
    <th class='text-center'>Calificación</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]['id']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["apellidoPaterno"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["apellidoMaterno"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["nombres"]."</td>";
      print "<td class='text-center'>".$datos["data"][$i]["calificacion"]."</td>";
      print "<td><a href='".RUTA."profesores/calificacionEstudiante/".$datos["data"][$i]["id"]."/".$datos["curso"]["id"]."' class='btn btn-warning'>Calificar</a></td>";
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