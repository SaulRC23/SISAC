<?php include_once("encabezado.php"); ?>
  <div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th>Clave</th>
    <th>Curso inscrito</th>
    <th>Fecha inicio</th>
    <th>Fecha final</th>
    <th class='text-center'>Calificación</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]['idCurso']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]['nombre']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fechaInicio"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fechaFin"]."</td>";
      print "<td class='text-center'>".$datos["data"][$i]["calificacion"]."</td>";
      print "<td><a href='".RUTA."estudiantes/calificaciones/".$datos["data"][$i]["idCurso"]."' class='btn btn-warning'>Calificaciones</a></td>";
      print "<td><a href='".RUTA."estudiantes/asistencias/".$datos["data"][$i]["idCurso"]."' class='btn btn-warning'>Asistencias</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  </div>
<?php include_once("piepagina.php"); ?>