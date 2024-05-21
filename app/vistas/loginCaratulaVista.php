<?php include("encabezado.php"); ?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
  const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
  const alertTrigger = document.getElementById('liveAlertBtn');

  const appendAlert = (message, type) => {
    // Verificar si ya hay una alerta presente
    const existingAlert = alertPlaceholder.querySelector('.alert');
    
    // Si no hay una alerta existente, agregar una nueva
    if (!existingAlert) {
      const wrapper = document.createElement('div');
      wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
      ].join('');

      alertPlaceholder.append(wrapper);
    }
  }

  if (alertTrigger) {
    alertTrigger.addEventListener('click', () => {
      appendAlert('En caso de no poder acceder al sistema, contacta con el administrador al siguiente correo: saulromero200323@gmail.com', 'alert alert-danger');
    });
  }
});
function onSubmit(token) {
  document.getElementById("ingresarBtn").disabled = false;
}
</script>
<form action="<?php print RUTA; ?>login/verificar/" method="POST">
	<div class="form-group text-left">
		<label for="usuario">Usuario:</label>
		<input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese su nombre de usuario" value="<?php if(isset($datos["data"]["usuario"])){ print $datos["data"]["usuario"]; } else { print '';} ?>">
	</div>
	
	<div class="form-group text-left">
		<label for="clave">Contraseña:</label>
		<input type="password" name="clave" id="clave" class="form-control" placeholder="Ingrese su contraseña" value="<?php if(isset($datos["data"]["clave"])){ print $datos["data"]["clave"]; } else { print '';} ?>">
	</div>

  <div class="form-group text-right mt-4">
    <div class="g-recaptcha" data-sitekey="6LfJf5QpAAAAALyeCwEBBKHcbbDOIC4C2gKP71tB" data-callback="onSubmit"></div>
  </div>
    
  <div class="form-group text-center mt-4">
    <input type="submit" id="ingresarBtn" class="btn btn-outline-primary" value="Ingresar" disabled>
  </div>

	<div class="form-check form-switch">
		<input name="recordar" class="form-check-input" type="checkbox" role="switch" id="recordar">
		<label class="form-check-label" for="recordar">Recordar datos de acceso.</label>
	</div>
	    <!--<a href="<?php //print RUTA; ?>login/olvido/">¿Olvidaste tu clave de acceso?</a>-->
</form>

<!-- Botón para activar la alerta en vivo -->
<div id="liveAlertPlaceholder"></div>
<div class="form-group text-right mt-4">
  <button type="button" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .75rem; --bs-btn-font-size: .75rem;" id="liveAlertBtn">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-book-half" viewBox="0 0 16 16">
      <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
    </svg>
    Ayuda
  </button>
</div>
<?php include("piepagina.php"); ?>