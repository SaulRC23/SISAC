<?php
/**
 * 
 */
class LoginModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function validarCorreo($usuario='')
	{
		// 
		if (empty($usuario)) return false;
		$sql = "SELECT * FROM usuarios WHERE correo='".$usuario."'";
		return $this->db->query($sql);
	}

	public function actualizarClaveAcceso($data)
	{
		// 
		if (empty($data)) return false;
		$sql = "UPDATE usuarios SET clave=:clave WHERE id=:id";
		return $this->db->queryNoSelect($sql,$data);
	}

	public function enviarCorreo($email='')
	{
		$data = [];
		if ($email=="") {
			return false;
		} else {
			$data = $this->validarCorreo($email);
			if (!empty($data)) {
				$id = Helper::encriptar($data["id"]);
				//
				$msg = "Entra a la siguiente liga para cambiar tu clave de acceso al control escolar...<br>";
				$msg.= "<a href='".RUTA."login/cambiarclave/".$id."'>Cambiar tu clave de acceso</a>";

				$headers = "MIME-Version: 1.0\r\n"; 
				$headers.= "Content-type:text/html; charset=UTF-8\r\n"; 
				$headers.= "From: Control de escuela\r\n"; 
				$headers.= "Reply-to: ayuda@escuela.com\r\n";

				$asunto = "Cambiar clave de acceso";
				var_dump($msg);
				return @mail($email,$asunto,$msg, $headers);
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
	}

}
?>