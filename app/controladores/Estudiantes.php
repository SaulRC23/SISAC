<?php  
/**
 * 
 */
class Estudiantes extends Controlador
{
	private $modelo = "";
	private $admon;
	private $usuario;
	private $sesion;
	
	function __construct()
	{
		$this->sesion = new Sesion();
		if ($this->sesion->getLogin()) {
			$this->modelo = $this->modelo("EstudiantesModelo");
			$this->usuario = $this->sesion->getUsuario();
			$this->admon = $this->sesion->getAdmon();
		} else {
			header("location:".RUTA);
		}
	}

	public function caratula()
	{
		$data = $this->modelo->getCursosEstudiante($this->usuario["id"]);
    $sub = $this->usuario["nombres"]." ".$this->usuario["apellidoPaterno"];
		$datos = [
			"titulo"=> "Tablero estudiante",
			"subtitulo" => $sub,
			"data" => $this->usuario,
			"admon" => $this->admon,
			"data" => $data,
			"menu" => true
		];
		$this->vista("estudiantesCaratulaVista",$datos);
	}

	public function calificaciones($idCurso="",$pagina=1)
	{
		//Leemos los datos de la tabla
		$idEstudiante=$this->usuario["id"];
		$data = $this->modelo->calificaciones($idCurso,$idEstudiante);
		$curso = $this->modelo->getIdCurso($idCurso);
		$usuario = $this->usuario;
		$tipoExamen = $this->modelo->getCatalogos("tipoExamen");
		//
		$datos = [
			"titulo" => "Calificación: ".$usuario["nombres"],
			"subtitulo" => "Calificación: ".$usuario["nombres"]." ".$usuario["apellidoPaterno"],
			"menu" => true,
			"admon" => $this->admon,
			"curso" => $curso,
			"usuario" => $usuario,
			"tipoExamen" => $tipoExamen,
			"data" => $data
		];
		$this->vista("estudiantesCalificacionClasesVista",$datos);
	}

	public function asistencias($idCurso="",$pagina=1)
  {
		//Leemos los datos de la tabla
		$idEstudiante=$this->usuario["id"];
		$num = $this->modelo->getNumClases($idCurso);
		$inicio = ($pagina-1)*TAMANO_PAGINA;
		$totalPaginas = ceil($num/TAMANO_PAGINA);
		$data = $this->modelo->getClases($idCurso,$idEstudiante,$inicio,TAMANO_PAGINA);
		$curso = $this->modelo->getIdCurso($idCurso);
		$usuario = $this->usuario;
		$tipoExamen = $this->modelo->getCatalogos("tipoExamen");
		//
		$datos = [
		  "titulo" => "Asistencia: ".$usuario["nombres"],
		  "subtitulo" => "Asistencia: ".$usuario["nombres"]." ".$usuario["apellidoPaterno"],
		  "menu" => true,
		  "admon" => $this->admon,
		  "curso" => $curso,
		  "usuario" => $usuario,
		  "tipoExamen" => $tipoExamen,
		  "pag" => [
		    "totalPaginas" => $totalPaginas,
		    "regresa" => "estudiantes/asistencias/".$idCurso,
		    "pagina" => $pagina
		  ],
		  "data" => $data
		];
		$this->vista("estudiantesAsistenciaClasesVista",$datos);
  }
}

?>