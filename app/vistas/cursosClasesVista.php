<?php include_once("encabezado.php"); 
function buscarTipoExamen($tipo,$datos)
{
  $salida = "";
  for ($i=0; $i < count($datos); $i++) { 
    if ($datos[$i]["clave"]==$tipo) {
      $salida = $datos[$i]["descripcion"];
      break;
    }
  }
  return $salida;
}
?>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>Num.</th>
    <th>Fecha</th>
    <th>Observación</th>
    <th>Examen</th>
    <th>Modificar</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".($i+1)."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["fecha"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["observacion"]."</td>";
      print "<td class='text-left'>";
      if($datos["data"][$i]["tipoExamen"]==0){
        print "---";
      } else {
        print buscarTipoExamen($datos["data"][$i]["tipoExamen"],$datos["tipoExamen"]);
      }
      print "</td>";
      //
      print "<td><a href='".RUTA."cursos/modificarClase/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."cursos/confirmarBorrarClase/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
</div>
<a href="<?php print RUTA.'cursos/horario/'.$datos['curso']['id']; ?>" class="btn btn-success">Regresar</a>
<?php include_once("piepagina.php"); ?>