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
    <th>#</th>
    <th>Fecha</th>
    <th>Tema</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      $ii = (($datos["pag"]["pagina"]-1)*TAMANO_PAGINA)+($i+1);
      print "<td class='text-left'>".($ii)."</td>";
      print "<td class='text-left'>".$datos["data"][$i]['fecha']."</td>";
      print "<td class='text-left'>".$datos["data"][$i]['observacion']."</td>";
      if ($datos["data"][$i]["idEstudiante"]==NULL) {
        //No existe
        print "<td><a href='#' class='btn btn-secondary disabled' style='width:100px;'>Pendiente</a></td>";
      } else if($datos["data"][$i]["estado"]==1){
        print "<td><a href='' class='btn btn-success disabled' style='width:100px;'>Asistencia</a></td>";
      } else {
        print "<td><a href='' class='btn btn-danger disabled' style='width:100px;'>Falta</a></td>";
      }
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
  <?php include("paginacion.php"); ?>
  </div>
<a href="<?php print RUTA; ?>estudiantes" class="btn btn-success">
  Regresar</a>
<?php include_once("piepagina.php"); ?>