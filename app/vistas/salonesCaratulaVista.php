<?php include("encabezado.php"); ?>
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>id</th>
    <th>Clave</th>
    <th>Descripción</th>
    <th>Nota</th>
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
      print "<td class='text-left'>".$datos["data"][$i]["descripcion"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["nota"]."</td>";
      //
      print "<td><a href='".RUTA."salones/modificar/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."salones/borrar/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  <?php include("paginacion.php"); ?>
<a href="<?php print RUTA; ?>salones/alta" class="btn btn-success">
  Dar de alta un salón</a>
<?php include("piepagina.php"); ?>