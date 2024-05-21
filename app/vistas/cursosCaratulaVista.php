<?php include("encabezado.php"); ?>
<div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>id</th>
    <th>Clave</th>
    <th>Nombre</th>
    <th>Fecha inicio</th>
    <th>Fecha final</th>
    <th>Horario</th>
    <th>Modificar</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]["id"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["clave"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["nombre"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fechaInicio"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fechaFin"]."</td>";
      //
      print "<td><a href='".RUTA."cursos/horario/".$datos["data"][$i]["id"]."' class='btn btn-warning'>Horario</a></td>";
      print "<td><a href='".RUTA."cursos/modificar/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."cursos/borrar/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
</div>
  <?php include("paginacion.php"); ?>
<a href="<?php print RUTA; ?>cursos/alta" class="btn btn-success">
  Dar de alta un curso</a>
<?php include("piepagina.php"); ?>