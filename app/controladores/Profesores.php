<?php  
/**
 * 
 */
class Profesores extends Controlador
{
	private $modelo = "";
	private $admon;
	private $usuario;
	private $sesion;
	
	function __construct()
	{
		$this->sesion = new Sesion();
		if ($this->sesion->getLogin()) {
			$this->modelo = $this->modelo("ProfesoresModelo");
			$this->usuario = $this->sesion->getUsuario();
			$this->admon = $this->sesion->getAdmon();
		} else {
			header("location:".RUTA);
		}
	}

	public function caratula()
	{
		$data = $this->modelo->getCursosProfesor($this->usuario["id"]);
		if ($this->usuario["genero"]==1) {
      		$sub = "Profesor ";
      	} else if ($this->usuario["genero"]==2){
      		$sub = "Profesora ";
      	} else {
      		$sub = "";
      	}
      	$sub.= $this->usuario["nombres"]." ".$this->usuario["apellidoPaterno"];
		$datos = [
			"titulo"=> "Tablero profesor",
			"subtitulo" => $sub,
			"data" => $this->usuario,
			"admon" => $this->admon,
			"data" => $data,
			"menu" => true
		];
		$this->vista("profesoresCaratulaVista",$datos);
	}

	/*****************************
	 * I N S C R I P C I O N E S
	 * ***************************/
	public function inscribir($idCurso,$pagina=1){
      //Leemos los datos de la tabla
      $num = $this->modelo->getNumEstudiantes($idCurso);
      $inicio = ($pagina-1)*TAMANO_PAGINA;
      $totalPaginas = ceil($num/TAMANO_PAGINA);
      $data = $this->modelo->getCursosEstudiantes($idCurso,$inicio,TAMANO_PAGINA);
      $curso = $this->modelo->getIdCurso($idCurso);
      //
      $datos = [
        "titulo" => $curso["nombre"],
        "subtitulo" => "Inscribir ".$curso["nombre"],
        "menu" => true,
        "admon" => $this->admon,
        "curso" => $curso,
        "pag" => [
          "totalPaginas" => $totalPaginas,
          "regresa" => "profesores/inscribir/".$idCurso,
          "pagina" => $pagina
        ],
        "data" => $data
      ];
      $this->vista("profesoresInscribirVista",$datos);
  }

  public function inscribirEstudiante($id,$idCurso){
    if($this->modelo->inscribirUsuario($id,$idCurso)){
      $this->inscribir($idCurso,1);
    } else {
      $this->mensaje(
	  		"Alta de la inscripción", 
	  		"Alta de la inscripción", 
	  		"Error al insertar la inscripción", 
	  		"profesores", 
	  		"danger"
	  	);
    }
  }

	/*****************************
	* A S I S T E N C I A S
	* ***************************/
	public function asistencia($idCurso,$pagina=1){
		//Leemos los datos de la tabla
		//Muestra la lista de alumnos inscritos
		//
		$num = $this->modelo->getNumEstudiantesInscritos($idCurso);
		$inicio = ($pagina-1)*TAMANO_PAGINA;
		$totalPaginas = ceil($num/TAMANO_PAGINA);
		$data = $this->modelo->getEstudiantesInscritos($idCurso,$inicio,TAMANO_PAGINA);
		$curso = $this->modelo->getIdCurso($idCurso);
		//
		$datos = [
			"titulo" => "Asistencia: ".$curso["nombre"],
			"subtitulo" => "Asistencia: ".$curso["nombre"],
			"menu" => true,
			"admon" => $this->admon,
			"curso" => $curso,
			"pag" => [
			  "totalPaginas" => $totalPaginas,
			  "regresa" => "profesores/asistencia/".$idCurso,
			  "pagina" => $pagina
			],
			"data" => $data
		];
		$this->vista("profesoresAsistenciaVista",$datos);
	}

	public function asistenciaEstudiante($idEstudiante='',$idCurso="",$pagina=1){
		//Leemos los datos de la tabla
		$num = $this->modelo->getNumClases($idCurso);
		$inicio = ($pagina-1)*TAMANO_PAGINA;
		$totalPaginas = ceil($num/TAMANO_PAGINA);
		$data = $this->modelo->getClases($idCurso,$inicio,TAMANO_PAGINA);
		$asistencias = $this->modelo->getAsistencias($idCurso,$idEstudiante);
		$curso = $this->modelo->getIdCurso($idCurso);
		$usuario = $this->modelo->getUsuarioId($idEstudiante);
		$tipoExamen = $this->modelo->getCatalogos("tipoExamen");
		//
		$datos = [
		  "titulo" => "Asistencia: ".$usuario["nombres"],
		  "subtitulo" => "Asistencia: ".$usuario["nombres"]." ".$usuario["apellidoPaterno"],
		  "menu" => true,
		  "admon" => $this->admon,
		  "curso" => $curso,
		  "usuario" => $usuario,
		  "asistencias" => $asistencias,
		  "tipoExamen" => $tipoExamen,
		  "pag" => [
		    "totalPaginas" => $totalPaginas,
		    "regresa" => "profesores/asistenciaEstudiante/".$idEstudiante."/".$idCurso,
		    "pagina" => $pagina
		  ],
		  "data" => $data
		];
		$this->vista("profesoresAsistenciaClasesVista",$datos);
	}

	public function actualizarAsistencia($idClase,$idCurso,$idEstudiante,$pag)
	{
		if($this->modelo->actualizarAsistencia($idClase,$idEstudiante,$idCurso,1)){
			$this->asistenciaEstudiante($idEstudiante,$idCurso,$pag);
		} else {
			$this->mensaje("Error al añadir la asistencia.","Error al añadir la asistencia.","Error al modificar la asistencia.","profesores","danger");
		}
	}

	public function actualizarFalta($idClase,$idCurso,$idEstudiante,$pag)
	{
		if($this->modelo->actualizarAsistencia($idClase,$idEstudiante,$idCurso,2)){
			$this->asistenciaEstudiante($idEstudiante,$idCurso,$pag);
		} else {
			$this->mensaje("Error al añadir la inasistencia.","Error al añadir la inasistencia.","Error al modificar la inasistencia.","profesores","danger");
		}
	}

	public function quitarAsistencia($idClase,$idCurso,$idEstudiante,$pag){
		if($this->modelo->quitarAsistencia($idClase,$idCurso,$idEstudiante)){
			$this->asistenciaEstudiante($idEstudiante,$idCurso,$pag);
		} else {
			$this->mensaje("Error al quitar la inasistencia.","Error al quitar la inasistencia.","Error al quitar la inasistencia.","profesores","danger");
		}
	}
	/*****************************
	* C A L I F I C A C I O N E S
	* ***************************/
	public function calificaciones($idCurso,$pagina=1){
		//Leemos los datos de la tabla
		$num = $this->modelo->getNumEstudiantesInscritos($idCurso);
		$inicio = ($pagina-1)*TAMANO_PAGINA;
		$totalPaginas = ceil($num/TAMANO_PAGINA);
		$data = $this->modelo->getEstudiantesInscritos($idCurso,$inicio,TAMANO_PAGINA);
		$curso = $this->modelo->getIdCurso($idCurso);
		//
		$datos = [
			"titulo" => "Calificaciones: ".$curso["nombre"],
			"subtitulo" => "Calificaciones: ".$curso["nombre"],
			"menu" => true,
			"admon" => $this->admon,
			"curso" => $curso,
			"pag" => [
			  "totalPaginas" => $totalPaginas,
			  "regresa" => "profesores/calificaciones/".$idCurso,
			  "pagina" => $pagina
			],
			"data" => $data
		];
		$this->vista("profesoresCalificacionesVista",$datos);
	}

	public function calificacionEstudiante($idEstudiante='',$idCurso="",$pagina=1)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getClases($idCurso);
		$calificaciones = $this->modelo->getCalificaciones($idCurso,$idEstudiante);
		$curso = $this->modelo->getIdCurso($idCurso);
		$usuario = $this->modelo->getUsuarioId($idEstudiante);
		$tipoExamen = $this->modelo->getCatalogos("tipoExamen");
		//
		//
		$datos = [
		  "titulo" => "Calificación: ".$usuario["nombres"],
		  "subtitulo" => "Calificación: ".$usuario["nombres"]." ".$usuario["apellidoPaterno"],
		  "menu" => true,
		  "admon" => $this->admon,
		  "curso" => $curso,
		  "calificaciones" => $calificaciones,
		  "usuario" => $usuario,
		  "tipoExamen" => $tipoExamen,
		  "data" => $data
		];
		$this->vista("profesoresCalificacionClasesVista",$datos);
	}

	public function actualizarCali($idClase,$idCurso,$idEstudiante)
	{
		$clase = $this->modelo->getIdClase($idClase);
		$curso = $this->modelo->getIdCurso($idCurso);
		$usuario = $this->modelo->getUsuarioId($idEstudiante);
		$cali = $this->modelo->getCaliCursoUsuario($idClase,$idEstudiante);
		$tipoExamen = $this->modelo->getCatalogos("tipoExamen");
		//
		$datos = [
			"titulo" => "Calificación: ".$usuario["nombres"],
			"subtitulo" => "Calificación: ".$usuario["nombres"]." ".$usuario["apellidoPaterno"],
			"menu" => true,
			"admon" => $this->admon,
			"curso" => $curso,
			"cali" => $cali,
			"usuario" => $usuario,
			"tipoExamen" => $tipoExamen,
			"clase" => $clase
		];
		$this->vista("profesoresCalificacionCRUDVista",$datos);
	}

	public function altaCalificacion(){
		$errores = [];
		if ($_SERVER['REQUEST_METHOD']=="POST") {
			//
			$idClase = $_POST['idClase'] ?? "";
			$idCurso = $_POST['idCurso'] ?? "";
			$idCali = trim($_POST['idCali'] ?? "");
			$idEstudiante = $_POST['idEstudiante'] ?? "";
			$cali = $_POST['cali'] ?? "0";
			$observacion = $_POST['observacion'] ?? "";
			$max = $_POST['max'] ?? "0";

			if($idClase==""){
				array_push($errores,"El identificador de la clase es requerido.");
			}

			if($idEstudiante==""){
				array_push($errores,"El identificador del estudiante es requerido.");
			}

			if($cali>$max){
				array_push($errores,"La calificació no puede sobrepasar la calificación máxima.");
			}

			if($cali<0){
				array_push($errores,"La calificación no puede ser menor a cero.");
			}

			if (empty($errores)) {
				//Iniciamos sesión
				if($idCali==""){
					if($this->modelo->altaCalificacion($idCurso, $idClase, $idEstudiante, $cali, $observacion)){
						$this->mensaje("Alta de calificación.","Alta de calificación.","Alta de calificación.","profesores/calificacionEstudiante/".$idEstudiante."/".$idCurso,"success");
						//
					} else {
						$this->mensaje("Error al crear la calificación.","Error al crear la calificación.","Error al crear la calificación.","profesores","danger");
					}
				} else {
					if($this->modelo->modificarCalificacion($idCali, $cali, $observacion)){
						$this->mensaje("Modificar la calificación.","Modificar la calificación.","Modificar la calificación.","profesores/calificacionEstudiante/".$idEstudiante."/".$idCurso,"success");
					} else {
						$this->mensaje("Error al modificar la calificación.","Error al modificar la calificación.","Error al modificar la calificación.","profesores","danger");
					}
				}
				$cali = $this->modelo->calcularCalificacion($idCurso,$idEstudiante);

				if (!$this->modelo->actualizarCalificacionEstudiante($idCurso,$idEstudiante,$cali)) {
					$this->mensaje("Error al actualizar la calificación del estudiante.","Error al actualizar la calificación del estudiante.","Error al actualizar la calificación del estudiante.","profesores","danger");
				}
			} else {
				$this->mensaje("Error al actualizar la calificación del estudiante.","Error al actualizar la calificación del estudiante.","Error al actualizar la calificación del estudiante.","profesores","danger");
			}    
		}
	}
}

?>