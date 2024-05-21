<?php include("encabezado.php"); ?>
<form action="<?php print RUTA; ?>login/olvido/" method="POST">
	<div class="form-group text-left">
		<label for="usuario">* Correo:</label>
		<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Escribe el usuario (correo electrónico)">
	</div>
	<div class="form-group text-left mt-2">
		<input type="submit" class="btn btn-success">
		<a href="<?php print RUTA; ?>" type="button" class="bt btn-info">Regresar</a>
	</div>
</form>
<?php include("piepagina.php"); ?>