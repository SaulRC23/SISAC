<?php include_once("encabezado.php"); ?>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>Indice</th>
    <th>Tipo</th>
    <th>Cadena</th>
    <th>Modificar</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    $tipo = $datos["data"][0]["tipo"];
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]["clave"]."</td>";
      print "<td class='text-left'>".$tipo."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["descripcion"]."</td>";
      //
      print "<td><a href='".RUTA."catalogos/cambiar/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."catalogos/borrar/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
</div>
<a href="<?php print RUTA.'catalogos/alta/'.$tipo;?>" class="btn btn-success">Dar de alta una llave</a>
<a href="<?php print RUTA;?>catalogos" class="btn btn-success">Regresar</a>
<?php include_once("piepagina.php"); ?>