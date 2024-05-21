<?php include("encabezado.php"); ?>
<form action="<?php print RUTA; ?>login/cambiarclave/" method="POST">
	<div class="form-group text-left">
		<label for="clave">* Nueva clave de acceso:</label>
		<input type="password" name="clave" id="clave" class="form-control" placeholder="Escribe tu nueva clave de acceso">
	</div>
	<div class="form-group text-left">
		<label for="verifica">* Repite tu clave de acceso:</label>
		<input type="password" name="verifica" id="verifica" class="form-control" placeholder="Repite tu nueva clave de acceso">
	</div>
	<div class="form-group text-left mt-2">
		<input type="hidden" name="id" id="id" value="<?php print $datos['data']; ?>">
		<input type="submit" class="btn btn-success">
	</div>
</form>
<?php include("piepagina.php"); ?>