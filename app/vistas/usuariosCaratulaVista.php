<?php include("encabezado.php"); ?>
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>id</th>
    <th>Tipo</th>
    <th>Nombre</th>
    <th>Apellido paterno</th>
    <th>Modificar</th>
    <th>Borrar usuario</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]["id"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["tipoUsuario"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["nombres"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["apellidoPaterno"]."</td>";
      //
      print "<td><a href='".RUTA."usuarios/modificar/".$datos["data"][$i]["id"]."' class='btn btn-info'>Editar</a></td>";
      print "<td><a href='".RUTA."usuarios/borrar/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Eliminar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  <?php include("paginacion.php"); ?>
<a href="<?php print RUTA; ?>usuarios/alta" class="btn btn-success">
  Dar de alta un usuario</a>
<?php include("piepagina.php"); ?>