<?php  
/**
 * 
 */
class Tablero extends Controlador
{
	private $modelo = "";
	private $admon;
	private $usuario;
	private $sesion;
	
	function __construct()
	{
		$this->sesion = new Sesion();
		if ($this->sesion->getLogin()) {
			$this->modelo = $this->modelo("TableroModelo");
			$this->usuario = $this->sesion->getUsuario();
			$this->admon = $this->sesion->getAdmon();
		} else {
			header("location:".RUTA);
		}
	}

	public function caratula()
	{
		//Leemos los datos de la tabla
      	$cursos = $this->modelo->getCursos();
      	$sub = $this->usuario["nombres"]." ".$this->usuario["apellidoPaterno"];
		$datos = [
			"titulo"=> "Entrada al sistema",
			"subtitulo" => $sub,
			"admon" => $this->admon,
			"data" => $this->usuario,
			"cursos" => $cursos,
			"menu" => true
		];
		$this->vista("tableroCaratulaVista",$datos);
	}

	public function logout()
	{
		if (isset($_SESSION['usuario'])) {
			$this->sesion->fializarLogin();
		}
		header("location:".RUTA);
	}

	public function perfil($value='')
	{
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			//
			$id = $_POST['id']??"";
			$nombres = Helper::cadena($_POST['nombres']??"");
			$apellidoPaterno = Helper::cadena($_POST['apellidoPaterno']??"");
			$apellidoMaterno = Helper::cadena($_POST['apellidoMaterno']??"");
			$nueva = $_POST['clave']??"";
			$verifica = $_POST['verifica']??"";

			if(empty($nombres)){
				array_push($errores, "El nombre del usuario no puede estar vacío.");
			}
			if(empty($apellidoPaterno)){
				array_push($errores, "El apellido paterno no puede estar vacío.");
			}
			if(empty($nueva)){
				array_push($errores, "El la nueva clave de acceso no puede estar vacía.");
			}
			if(empty($verifica)){
				array_push($errores, "El la nueva clave de acceso de verificación no puede estar vacía.");
			}
			if($nueva!=$verifica){
				array_push($errores, "Las claves de acceso no coinciden.");
			}
			//
			if (empty($errores)) {
				if ($this->modelo->setUsuario($id, $nombres, $apellidoPaterno, $apellidoMaterno,$nueva)) {
					$data = $this->modelo->getUsuarioId($id);
					$this->sesion->setUsuario($data);
					 $this->mensaje(
		          		"Modificación del perfil exitoso", 
		          		"Modificación del perfil exitoso", 
		          		"Modificación del perfil exitoso ", 
		          		"tablero", 
		          		"success"
		          	);
				} else {
					$this->mensaje(
		          		"Error al modificar del perfil", 
		          		"Error al modificar del perfil", 
		          		"Error al modificar del perfil", 
		          		"tablero", 
		          		"danger"
		          	);
				}
				exit;
			}
		}

		//
		$datos = [
			"titulo"=> "Perfil del usuario",
			"subtitulo" => "Perfil del usuario",
			"admon" => $this->admon,
			"menu" => true,
			"activo" => "perfil",
			"errores" => $errores,
			"data" => $this->usuario
		];
		$this->vista("tableroPerfilVista",$datos);
	}

	public function respaldar()
	{
		$m = "Cuidado: Este proceso realiza el respaldo de la base de datos. Puede tardar algunos minutos.";
    	$this->mensaje(
	  		"Respaldar la base de datos", 
	  		"Respaldar la base de datos", 
	  		$m, 
	  		"tablero",
	  		"danger",
	  		"tablero/respaldarEjecutar/",
	  		"success",
	  		"Respaldar"
	  	);
	}

	public function respaldarEjecutar()
	{
		$fecha = date("Ymdhis");
		$id = uniqid();
		$tablas = $this->modelo->getTablas();
		foreach ($tablas as $tabla) {
			$this->modelo->respaldarTabla($tabla["Tables_in_escuela"],$fecha,$id);
		}
		$this->mensaje("Respaldo de base de datos",
		"Respaldo de base de datos",
		"El respaldo de base de datos fue exitosa.<br>En la carpeta:<br>respaldos/".$fecha."-".$id,
		"tablero",
		"success");
	}
}

?>