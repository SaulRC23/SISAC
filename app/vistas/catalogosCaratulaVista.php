<?php include("encabezado.php"); ?>
<div class="table-responsive">
  <table class="table table-striped" width="100%">
  <thead>
  <tr>
    <th>Tipo</th>
    <th>Elementos</th>
    <th>Modificar</th>
  </tr>
  </thead>
  <tbody>
    <?php
    for($i=0; $i<count($datos['data']); $i++){
      print "<tr>";
      print "<td class='text-left'>".$datos["data"][$i]["tipo"]."</td>";
      print "<td class='text-left'>".$datos["data"][$i]["num"]."</td>";
      // 
      print "<td><a href='".RUTA."catalogos/mostrar/".$datos["data"][$i]["tipo"]."' class='btn btn-info'>Mostrar</a></td>";
      print "</tr>";
    }
    ?>
  </tbody>
  </table>
</div>
<?php include("piepagina.php"); ?>