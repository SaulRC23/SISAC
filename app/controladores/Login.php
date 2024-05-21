<?php  
/**
 * 
 */
class Login extends Controlador
{
	private $modelo = "";
	
	function __construct()
	{
		$this->modelo = $this->modelo("LoginModelo");
	}

	public function caratula()
	{
		if (isset($_COOKIE['datos'])) {
			$datos_array = explode("|",$_COOKIE['datos']);
			$usuario = $datos_array[0];
			$clave = Helper::desencriptar($datos_array[1]);
			$data = [
				"usuario" => $usuario,
				"clave" => $clave
			];
		} else {
			$data = [];
		}
		
		$datos = [
			"titulo"=> "Entrada al sistema",
			"subtitulo" => "SISAC",
			"menu" => false,
			"admon" => "admon",
			"data" => $data
		];
		$this->vista("loginCaratulaVista",$datos);
	}

	public function olvido()
	{
		$errores = [];
		//
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$usuario = $_POST['usuario']??"";
			//
			if (empty($usuario)) {
				array_push($errores, "El correo electrónico es requerido.");
			}
			if (filter_var($usuario,FILTER_VALIDATE_EMAIL)==false) {
				array_push($errores, "El correo electrónico no es válido.");
			}
			//
			if (empty($errores)) {
				// Validar en la base de datos
				if ($this->modelo->validarCorreo($usuario)) {
					if ($this->modelo->enviarCorreo($usuario)) {
						$datos = [
						"titulo" => "Cambio de clave de acceso",
						"menu" => false,
						"errores" => [],
						"data" => [],
						"subtitulo" => "Cambio de clave de acceso",
						"texto" => "Se ha enviado un correo a <b>".$usuario."</b> para que puedas cambiar tu clave de acceso. Cualquier duda te puedes comunicar con nosotros. No olvides revisar tu bandeja de spam.",
						"color" => "alert-success",
						"url" => "login",
						"colorBoton" => "btn-success",
						"textoBoton" => "Regresar"
						];
						$this->vista("mensaje",$datos);
					} else {
						$datos = [
						"titulo" => "Cambio de clave de acceso",
						"menu" => false,
						"errores" => [],
						"data" => [],
						"subtitulo" => "Cambio de clave de acceso",
						"texto" => "Existió un error al enviar el correo electrónico. Favor de intentarlo más tarde o reportarlo a soporte técnico.",
						"color" => "alert-danger",
						"url" => "login",
						"colorBoton" => "btn-danger",
						"textoBoton" => "Regresar"
						];
						$this->vista("mensaje",$datos);
					}
					
				} else {
					$datos = [
					"titulo" => "Cambio de clave de acceso",
					"menu" => false,
					"errores" => [],
					"data" => [],
					"subtitulo" => "Cambio de clave de acceso",
					"texto" => "Existió un error al enviar el correo electrónico. Favor de intentarlo más tarde o reportarlo a soporte técnico.",
					"color" => "alert-danger",
					"url" => "login",
					"colorBoton" => "btn-danger",
					"textoBoton" => "Regresar"
					];
					$this->vista("mensaje",$datos);
					}
			}
			exit;
		}
		$datos = [
			"titulo"=> "Olvido de la clave",
			"subtitulo" => "Olvidaste la clave de acceso",
			"errores" => $errores,
			"data" => []
		];
		$this->vista("loginOlvidoVista",$datos);
	}

	public function cambiarclave($data='')
	{
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$id = $_POST['id']??"";
			$clave1 = $_POST["clave"]??"";
			$clave2 = $_POST["verifica"]??"";
			$id = Helper::desencriptar($id);
			//
			if (empty($clave1)) {
				array_push($errores,"La clave de acceso es requerida.");
			}
			if (empty($clave2)) {
				array_push($errores,"La clave de acceso de verificación es requerida.");
			}
			if ($clave1!=$clave2) {
				array_push($errores,"Las claves de acceso no coinciden.");
			}
			//
			if (count($errores)==0) {
				$clave = hash_hmac("sha512", $clave1, CLAVE);
				$data = ["clave"=>$clave, "id"=>$id];
				if ($this->modelo->actualizarClaveAcceso($data)) {
					$datos = [
					"titulo" => "Cambio de clave de acceso",
					"menu" => false,
					"errores" => [],
					"data" => [],
					"subtitulo" => "Cambio de clave de acceso",
					"texto" => "La clave de acceso se modificó correctamente.",
					"color" => "alert-success",
					"url" => "login",
					"colorBoton" => "btn-success",
					"textoBoton" => "Regresar"
					];
					$this->vista("mensaje",$datos);
				} else {
					$datos = [
					"titulo" => "Cambio de clave de acceso",
					"menu" => false,
					"errores" => [],
					"data" => [],
					"subtitulo" => "Cambio de clave de acceso",
					"texto" => "Existió un error al actualizar la clave de acceso. Favor de intentarlo más tarde o reportarlo a soporte técnico.",
					"color" => "alert-danger",
					"url" => "login",
					"colorBoton" => "btn-danger",
					"textoBoton" => "Regresar"
					];
					$this->vista("mensaje",$datos);
				}
				exit;
			}	
		}
		$id = Helper::desencriptar($data);
		$datos=[
			"titulo" => "Cambiar constraseña",
			"subtitulo" => "Cambiar constraseña",
			"errores" => $errores,
			"data" => $id
		];
		$this->vista("loginCambiarVista",$datos);
	}

	public function verificar()
	{
		$errores = [];
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			// Validar reCAPTCHA
			$recaptchaSecretKey = "6LfJf5QpAAAAAHBC95Qxyip1XjJ4CBfZsLAwqkUF";
			$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
	
			$recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecretKey}&response={$recaptchaResponse}";
			$recaptchaResult = json_decode(file_get_contents($recaptchaUrl), true);
	
			if (!$recaptchaResult['success']) {
				array_push($errores, "Por favor, complete la verificación del reCAPTCHA.");
			}
		}

		if ($_SERVER['REQUEST_METHOD']=="POST") {
			$id = $_POST['id']??"";
			$usuario = $_POST["usuario"]??"";
			$clave = $_POST["clave"]??"";
			$recordar = isset($_POST['recordar'])?"on":"off";
			//Recordar
			$valor = $usuario."|".Helper::encriptar($clave);
			if ($recordar=="on") {
				$fecha = time()+(60*60*24*7);
			} else {
				$fecha = time()-1;
			}
			setcookie("datos",$valor,$fecha,RUTA);
			//
			if (empty($usuario)) {
				array_push($errores,"La clave de acceso de verificación es requerida.");
			}
			if (empty($clave)) {
				$data = $this->modelo->validarCorreo($usuario);
				$id = $data["id"];
				if(empty($id)){
					$this->mensaje(
		          		"Aviso", 
		          		"Aviso", 
		          		"No se ingresaron los datos de acceso, intente nuevamente.", 
		          		"login", 
		          		"danger"
		          	);
				} else {
					$datos = [
						"titulo" => "Añadir constraseña",
						"subtitulo" => "Añadir constraseña",
						"menu" => false,
						"admon" => "admon",
						"errores" => [],
						"data" => Helper::encriptar($id)
					];
					$this->vista("loginCambiarVista",$datos);
				}
				exit;				
			}

			//
			if (count($errores)==0) {
				//
				$clave = hash_hmac("sha512", $clave, CLAVE);
				$data = $this->modelo->validarCorreo($usuario);
				//
				if ($data["clave"]==$clave) {
					$sesion = new Sesion();
					$sesion->iniciarLogin($data);
					//
					if ($data["tipo"]==ADMON) {
						header("location:".RUTA."tablero");
					} else if ($data["tipo"]==PROFESOR){
						header("location:".RUTA."profesores");
					} else if ($data["tipo"]==ESTUDIANTE){
						header("location:".RUTA."estudiantes");
					}
				} else {
					$datos = [
					"titulo" => "Sistema escolar",
					"menu" => false,
					"errores" => [],
					"data" => [],
					"subtitulo" => "Aviso",
					"texto" => "Datos de acceso incorrectos, intente nuevamente.",
					"color" => "alert-danger",
					"url" => "login",
					"colorBoton" => "btn-danger",
					"textoBoton" => "Regresar"
					];
					$this->vista("mensaje",$datos);
				}
			}	
		}
	}
}

?>