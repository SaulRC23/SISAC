<?php include_once("encabezado.php"); 
function tipoExamen($tipo,$tipoExamen)
{
  $salida = "";
  for ($i=0; $i < count($tipoExamen); $i++) { 
    if ($tipo==$tipoExamen[$i]["clave"]) {
      $salida = $tipoExamen[$i]["descripcion"];
      break;
    }
  }
  return $salida;
}

?>
  <div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
    <tr>
    <th class='text-center'>Num. clase</th>
    <th>Fecha</th>
    <th>Observación</th>
    <th>Examen</th>
    <th class='text-center'>Valor</th>
    <th class='text-center'>Calificación</th>
  </tr>
  </thead>
  <tbody>
    <?php
    $cali = 0;
    $ii = 0;
    for($i=0; $i<count($datos['data']); $i++){
        print "<tr>";
        print "<td class='text-center'>".($i+1)."</td>";
        print "<td class='text-left'>".$datos["data"][$i]['fecha']."</td>";
        print "<td class='text-left'>".$datos["data"][$i]['observacion']."</td>";
        print "<td class='text-left'>".tipoExamen($datos["data"][$i]["tipoExamen"],$datos["tipoExamen"])."</td>";
        print "<td class='text-center'>".$datos["data"][$i]["calificacion"]."</td>";
        if ($datos["data"][$i]["cali"]==NULL) {
          print "<td class='text-center'>0</td>";
        } else {
          print "<td class='text-center'>".$datos["data"][$i]["cali"]."</td>";
          $cali += $datos["data"][$i]["cali"];
          $ii++;
        }
        print "</tr>";
    }
    if($ii==0){
      $k = 0;
    } else {
      $k = round($cali/$ii,0);
    }
    print "<tr><td></td><td>Total:</td><td></td><td></td><td></td><td class='text-center'><b>".$k."</b></td></tr>";
    ?>
  </tbody>
  </table>
  </div>
<a href="<?php print RUTA.'estudiantes';?>" class="btn btn-success">
  Regresar</a>
<?php include_once("piepagina.php"); ?>