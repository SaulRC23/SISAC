<?php include("encabezado.php"); ?>
  <div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>Clave</th>
    <th>Nombre</th>
    <th>Fecha inicio</th>
    <th>Fecha final</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]['clave']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]['nombre']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fechaInicio"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fechaFin"]."</td>";
      print "<td><a href='".RUTA."profesores/asistencia/".$datos["data"][$i]["id"]."' class='btn btn-warning'>Asistencia</a></td>";
      print "<td><a href='".RUTA."profesores/calificaciones/".$datos["data"][$i]["id"]."' class='btn btn-warning'>Calificaciones</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  </div>
<?php include("piepagina.php"); ?>