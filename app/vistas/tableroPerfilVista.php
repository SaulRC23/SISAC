<?php include("encabezado.php"); ?>
<form action="<?php print RUTA; ?>tablero/perfil/" method="POST">
	<div class="form-group text-left">
		<label for="nombres">Nombre(s):</label>
		<input type="text" name="nombres" id="nombres" class="form-control" placeholder="Escribe tu nombre." value="<?php print isset($datos['data']['nombres'])?$datos['data']['nombres']:'';?>">
	</div>
	<div class="form-group text-left">
		<label for="apellidoPaterno">Apellido paterno:</label>
		<input type="text" name="apellidoPaterno" id="apellidoPaterno" class="form-control" placeholder="Escribe tu nueva clave de acceso" autocomplete="off"  value="<?php print isset($datos['data']['apellidoPaterno'])?$datos['data']['apellidoPaterno']:'';?>">
	</div>
	<div class="form-group text-left">
		<label for="apellidoMaterno">Apellido Materno:</label>
		<input type="text" name="apellidoMaterno" id="apellidoMaterno" class="form-control" placeholder="Escribe tu apellido materno" value="<?php print isset($datos['data']['apellidoMaterno'])?$datos['data']['apellidoMaterno']:'';?>" autocomplete="off">
	</div>
	<div class="form-group text-left">
		<label for="clave">* Nueva clave de acceso:</label>
		<input type="password" name="clave" id="clave" class="form-control" placeholder="Escribe tu nueva clave de acceso" autocomplete="off">
	</div>
	<div class="form-group text-left">
		<label for="verifica">* Repite tu clave de acceso:</label>
		<input type="password" name="verifica" id="verifica" class="form-control" placeholder="Repite tu nueva clave de acceso" autocomplete="off">
	</div>
	<div class="form-group text-left mt-2">
		<input type="hidden" name="id" id="id" value="<?php print $datos['data']["id"]; ?>">
		<input type="submit" class="btn btn-success">
	</div>
</form>
<?php include("piepagina.php"); ?>