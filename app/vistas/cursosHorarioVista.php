<?php include_once("encabezado.php"); ?>
<div class="card p-4 bg-light">
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>Dia</th>
    <th>Inicio</th>
    <th>Final</th>
    <th>Modificar</th>
    <th>Borrar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]["diaCadena"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["horaInicio"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["horaFin"]."</td>";
      //
      print "<td><a href='".RUTA."cursos/confirmarModificarHorario/".$datos["data"][$i]["id"]."' class='btn btn-info'>Modificar</a></td>";
      print "<td><a href='".RUTA."cursos/confirmarBorrarHorario/".$datos["data"][$i]["id"]."' class='btn btn-danger'>Borrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
</div>
<!--card-->
<a href="<?php print RUTA.'cursos/altaHorario/'.$datos['curso']['id'];?>" class="btn btn-success">
  Dar de alta un horario</a>
<?php
if(count($datos["clases"])>0){
  print '<a href="'.RUTA.'cursos/clases/'.$datos['curso']['id'].'" class="btn btn-success">Visualizar las clases</a> ';
} else {
  print '<a href="'.RUTA.'cursos/crearClases/'.$datos['curso']['id'].'" class="btn btn-success">Crear clases</a> ';
}
?>
<a href="<?php print RUTA; ?>cursos" class="btn btn-success">Regresar</a>
<?php include_once("piepagina.php"); ?>