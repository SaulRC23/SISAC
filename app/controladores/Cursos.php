<?php  
/**
 * 
 */
class Cursos extends Controlador
{
	private $modelo = "";
	private $admon;
	
	function __construct()
	{
		//Creamos sesion
		$sesion = new Sesion();
		if ($sesion->getLogin()) {
			$this->modelo = $this->modelo("CursosModelo");
			$this->admon = $sesion->getAdmon();
		} else {
			header("location:".RUTA);
		}
		
		
	}

	public function caratula($pagina=1)
	{
		//Leemos los datos de la tabla
		$num = $this->modelo->getNumRegistros();
		$inicio = ($pagina-1)*TAMANO_PAGINA;
		$totalPaginas = ceil($num/TAMANO_PAGINA);
		$data = $this->modelo->getTabla($inicio,TAMANO_PAGINA);

		$datos = [
			"titulo"=> "Cursos",
			"subtitulo" => "Cursos",
			"admon" => $this->admon,
			"activo" => "cursos",
			"data" => $data,
			"pag" => [
				"totalPaginas" => $totalPaginas,
				"regresa" => "cursos",
				"pagina" => $pagina
			],
			"menu" => true
		];
		$this->vista("cursosCaratulaVista",$datos);
	}

	public function alta(){
	   //Definir los arreglos
	    $data = array();
	    $errores = array();

	    //Recibimos la información de la vista
	    if ($_SERVER['REQUEST_METHOD']=="POST") {
	      	//
		  	if (isset($_FILES["temarioNuevo"]) && !empty($_FILES["temarioNuevo"]["name"])) {
				$archivo = $_FILES["temarioNuevo"];
				$temario = $archivo["name"];
				$tmp = $archivo["tmp_name"];
				$tipo = $archivo["type"];
				$size = $archivo["size"];
				$carpeta = "temarios/";

				if ($tipo == "application/pdf") {
					move_uploaded_file($tmp, $carpeta.$temario);
				} else {
				  	array_push($errores,"El tipo de archivo no es permitido.");
				}
			} else {
				$temario = Helper::cadena($_POST['temario'] ?? "");
			}
			$id = $_POST['id'] ?? "";
			$clave = Helper::cadena($_POST['clave'] ?? "");
			$idMateria = $_POST['idMateria'] ?? "void";
			$nombre = Helper::cadena($_POST['nombre'] ?? "");
			$idSalon = $_POST['idSalon'] ?? "void";
			$idProfesor = $_POST['idProfesor'] ?? "void";
			$fechaInicio = $_POST['fechaInicio'] ?? "";
			$fechaFin = $_POST['fechaFin'] ?? "";
			//
	      // Validamos la información
	      // 
	      if(empty($nombre)){
	        array_push($errores,"El nombre del curso es requerido.");
	      }
	      if(empty($clave)){
	        array_push($errores,"La clave del curso es requerida.");
	      }
	      if($idMateria=="void"){
	        array_push($errores,"La materia es requerida.");
	      }
	      if($idProfesor=="void"){
	        array_push($errores,"El profesor es requerido.");
	      }
	      if(Helper::fecha($fechaInicio)==false){
	        array_push($errores,"La fecha de inicio es incorrecta.");
	      }
	      if(Helper::fecha($fechaFin)==false){
	        array_push($errores,"La fecha final es incorrecta.");
	      }
	      if($fechaInicio>$fechaFin){
	        array_push($errores,"La fecha inicial no puede ser mayor a la fecha final.");
	      }

	      if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$data = [
			 "id" => $id,
			 "clave"=>$clave,
			 "nombre"=> $nombre,
			 "temario" => $temario,
			 "idSalon" => $idSalon,
			 "idProfesor" => $idProfesor,
			 "idMateria" => $idMateria,
			 "fechaInicio" => $fechaInicio,
			 "fechaFin" => $fechaFin
			];      
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->alta($data)) {
	            $this->mensaje(
	          		"Alta de un curso", 
	          		"Alta de un curso", 
	          		"Se añadió correctamente el curso: ".$nombre, 
	          		"cursos", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir un curso.", 
	          		"Error al añadir un curso.", 
	          		"Error al modificar un curso: ".$nombre, 
	          		"cursos", 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificar
	          if ($this->modelo->modificar($data)) {
	            $this->mensaje(
	          		"Modificar el curso", 
	          		"Modificar el curso", 
	          		"Se modificó correctamente el curso: ".$nombre,
	          		"cursos", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar el curso.", 
	          		"Error al modificar el curso.", 
	          		"Error al modificar el curso: ".$nombre, 
	          		"cursos", 
	          		"danger"
	          	);
	          }
	        }
	      }
	    } 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Alta
	    	$salones = $this->modelo->getSalones();
	    	if (empty($salones)) {
	    		$this->mensaje(
	          		"Error al acceder a cursos.", 
	          		"Error al acceder a cursos.", 
	          		"No hay salones dados de alta", 
	          		"cursos", 
	          		"danger"
	          	);
	    	}
	    	$profesores = $this->modelo->getProfesores();
	    	if (empty($profesores)) {
	    		$this->mensaje(
	          		"Error al acceder a cursos.", 
	          		"Error al acceder a cursos.", 
	          		"No hay profesores dados de alta", 
	          		"cursos", 
	          		"danger"
	          	);
	    	}
	    	$materias = $this->modelo->getMaterias();
	    	if (empty($materias)) {
	    		$this->mensaje(
	          		"Error al acceder a cursos.", 
	          		"Error al acceder a cursos.", 
	          		"No hay materias dados de alta", 
	          		"cursos", 
	          		"danger"
	          	);
	    	}
		    $datos = [
		      "titulo" => "Alta de un curso",
		      "subtitulo" => "Alta de un curso",
		      "activo" => "cursos",
		      "menu" => true,
		      "admon" => "admon",
		      "profesores" => $profesores,
		      "materias" => $materias,
		      "salones" => $salones,
		      "errores" => $errores,
		      "data" => []
		    ];
		    $this->vista("cursosAltaVista",$datos);
	    }
  	}

  	public function borrar($id=""){
	    //Leemos los datos del registro del id
	    $data = $this->modelo->getId($id);
	    $salones = $this->modelo->getSalones();
	    $profesores = $this->modelo->getProfesores();
	    $materias = $this->modelo->getMaterias();
	    $ir_array = $this->modelo->getIntegridadReferencial($id);

	    if ($ir_array["total"]==0) {
			$datos = [
				"titulo" => "Borrar curso",
				"subtitulo" =>"Borrar curso",
				"menu" => true,
				"admon" => "admon",
				"profesores" => $profesores,
			    "materias" => $materias,
			    "salones" => $salones,
				"activo" => "cursos",
				"baja" => true,
				"data" => $data
			];
			$this->vista("cursosAltaVista",$datos);
		} else {
			$m = "No podemos eliminar el curso porque tiene:<ul>";
			foreach ($ir_array as $llave => $valor) {
				if ($valor>0 && $llave!="total") {
					$m.="<li>".$valor." ".$llave."</li>";
				}
			}
			$m.="</ul>Total: ".$ir_array["total"]." registros.<br><br>";
			$m.="Primero debe eliminar las referencias.";
			$this->mensaje(
        		"Error al borrar el curso", 
        		"Error al borrar el curso", 
        		$m, 
        		"cursos", 
        		"danger"
        	);
		}
	  }

  public function bajaLogica($id=''){
	   if (isset($id) && $id!="") {
	     if ($this->modelo->bajaLogica($id)) {
        	$this->mensaje(
        		"Borrar el curso", 
        		"Borrar el curso", 
        		"Se borró correctamente el curso.", 
        		"cursos", 
        		"success"
        	);
        } else {
        	$this->mensaje(
        		"Error al borrar el curso", 
        		"Error al borrar el curso", 
        		"Error al borrar el curso.", 
        		"cursos", 
        		"danger"
        	);
        }
	   }
	}

  	public function modificar($id)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getId($id);
		$salones = $this->modelo->getSalones();
	    $profesores = $this->modelo->getProfesores();
	    $materias = $this->modelo->getMaterias();
		$datos = [
			"titulo" => "Modificar curso",
			"subtitulo" =>"Modificar curso",
			"menu" => true,
			"admon" => "admon",
			"profesores" => $profesores,
		    "materias" => $materias,
		    "salones" => $salones,
			"activo" => "cursos",
			"data" => $data
		];
		$this->vista("cursosAltaVista",$datos);
	}

	/*****************
	 * HORARIOS
	 * ***************/
	public function horario($idCurso)
	{
		if(empty($idCurso)) return false;
		//Leemos los datos de la tabla
		$curso = $this->modelo->getId($idCurso);
		$data = $this->modelo->getHorario($idCurso);
		$clases = $this->modelo->getClases($idCurso);
		$datos = [
			"titulo" => "Horario de: ".$curso["nombre"],
			"subtitulo" =>"Horario de: ".$curso["nombre"],
			"menu" => true,
			"admon" => "admon",
			"activo" => "cursos",
			"clases" => $clases,
			"curso" => $curso,
			"data" => $data
		];
		$this->vista("cursosHorarioVista",$datos);
	}

	public function altaHorario($id){
	  //Definir los arreglos
	  $data = array();
	  $errores = array();
	  //Recibimos la información de la vista
	  if ($_SERVER['REQUEST_METHOD']=="POST") {
	    //
	  	$id = $_POST['id'] ?? "";
	      //
	      $idCurso = $_POST['idCurso'] ?? "";
	      $idSalon = $_POST['idSalon'] ?? "void";
	      $dia = $_POST['dia'] ?? "void";
	      $horaInicio = $_POST['horaInicio'] ?? "";
	      $horaFin = $_POST['horaFin'] ?? "";
	      $observacion = $_POST['observacion'] ?? "";
	      //Helper::mostrar($_POST);
	      //
	      // Validamos la información
	      // 
	      if(empty($idCurso)){
	        array_push($errores,"La clave del curso es requerida.");
	      }
	      if($idSalon=="void"){
	        array_push($errores,"La clave del salón es requerida.");
	      }
	      if($dia=="void"){
	        array_push($errores,"El día del horario es requerida.");
	      }
	      if(empty($horaInicio)){
	        array_push($errores,"El horario inicial es requerido.");
	      }
	      if(empty($horaFin)){
	        array_push($errores,"El horario final es requerido.");
	      }
	      // Crear arreglo de datos
	      //
	      $data = [
	         "id" => $id,
	         "idCurso"=>$idCurso,
	         "idSalon"=> $idSalon,
	         "dia"=> $dia,
	         "horaInicio"=> $horaInicio,
	         "horaFin" => $horaFin,
	         "observacion" => $observacion
	      ];
	      if (empty($errores)) {       
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->altaHorario($data)) {
	            $this->mensaje(
	          		"Alta del horario del curso", 
	          		"Alta del horario del curso", 
	          		"Se añadió correctamente el horario del curso: ".$idCurso, 
	          		"cursos/horario/".$idCurso, 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir el curso.", 
	          		"Error al añadir el curso.", 
	          		"Error al modificar el curso: ".$nombre, 
	          		"cursos/horario/".$idCurso, 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificacion
	          if ($this->modelo->modificarHorario($data)) {
	          	$this->mensaje(
	          		"Modificar un horario", 
	          		"Modificar un horario", 
	          		"Se modificó correctamente el horario.", 
	          		"cursos/horario/".$idCurso,
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar el horario", 
	          		"Error al modificar el horario", 
	          		"Error al modificar el horario.", 
	          		"cursos/horario/".$idCurso, 
	          		"danger"
	          	);
	          }
	        }
	      }
	    }
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST"){
	    	//Vista Alta
	    	$curso = $this->modelo->getId($id);
	    	$salones = $this->modelo->getSalones();
	    	$dias = $this->modelo->getLlaves("dia");
	    	//
		    $datos = [
		      "titulo" => "Horario curso: ".$curso["nombre"],
		      "subtitulo" => "Alta de un horario: ".$curso["nombre"],
		      "activo" => "cursos",
		      "menu" => true,
		      "admon" => "admon",
		      "salones" => $salones,
		      "dias" => $dias,
		      "curso"=>$curso,
		      "errores" => $errores,
		      "data" => $data
		    ];
		    $this->vista("cursosHorarioAltaVista",$datos);
	    }
	}
	public function confirmarModificarHorario($id)
	{
	    $clases = $this->modelo->getClases($id);
	    if(count($clases)>0){
	    	$m = "Cuidado: Las clases para este curso <b><i>ya fueron creadas</i></b>. Si llega a modificar el horario debe de crear nuevamente las clases y se pueden perder datos relacionados.";
	    	$this->mensaje(
		  		"Modificar el horario", 
		  		"Modificar el horario", 
		  		$m, 
		  		"cursos/horario/".$id,
		  		"danger",
		  		"cursos/modificarHorario/".$id,
		  		"success",
		  		"Modificar horario"
		  	);
	    } else {
	    	$this->modificarHorario($id);
	    }
	}
	public function modificarHorario($idHorario)
	{
		$data = $this->modelo->getIdHorario($idHorario);
	    $salones = $this->modelo->getSalones();
	    $dias = $this->modelo->getLlaves("dia");
	    $curso = $this->modelo->getId($data["idCurso"]);
		//
		$datos = [
			"titulo" => "Modificar un horario: ".$curso["nombre"],
			"subtitulo" => "Modificar un horario: ".$curso["nombre"],
			"activo" => "cursos",
			"menu" => true,
			"admon" => "admon",
			"salones" => $salones,
			"dias" => $dias,
			"curso"=>$curso,
			"errores" => [],
			"data" => $data
		];
		$this->vista("cursosHorarioAltaVista",$datos);
	}

	public function confirmarBorrarHorario($id)
	{
		$clases = $this->modelo->getClases($id);
		if(count($clases)>0){
			$m = "Cuidado: Las clases para este curso <b><i>ya fueron creadas</i></b>. Si llega a borrar el horario debe de crear nuevamente las clases y se pueden perder datos relacionados.";
			$this->mensaje(
				"Borrar el horario", 
				"Borrar el horario", 
				$m, 
				"cursos/horario/".$id,
				"danger",
				"cursos/borrarHorario/".$id,
				"success",
				"Borrar horario"
				);
		} else {
			$this->borrarHorario($id);
		}
	}

	public function bajaLogicaHorario($id=''){
		if (isset($id) && $id!="") {
			if ($this->modelo->bajaLogicaHorario($id)) {
				$this->mensaje(
					"Borrar un horario", 
					"Borrar un horario", 
					"Se borró correctamente el horario del curso.", 
					"cursos", 
					"success"
				);
			} else {
				$this->mensaje(
					"Error al borrar el horario del curso", 
					"Error al borrar el horario del curso", 
					"Error al borrar el horario del curso.", 
					"cursos", 
					"danger"
				);
			}
		}
	}

	public function borrarHorario($id)
	{
		$data = $this->modelo->getIdHorario($id);
		$salones = $this->modelo->getSalones();
		$dias = $this->modelo->getLlaves("dia");
		$curso = $this->modelo->getId($data["idCurso"]);
		//
		$datos = [
			"titulo" => "Borrar un horario: ".$curso["nombre"],
			"subtitulo" => "Borrar un horario: ".$curso["nombre"],
			"activo" => "cursos",
			"menu" => true,
			"baja" => true,
			"admon" => "admon",
			"salones" => $salones,
			"dias" => $dias,
			"curso"=>$curso,
			"errores" => [],
			"data" => $data
		];
		$this->vista("cursosHorarioAltaVista",$datos);
	}
	/**************
	 * C L A S E S
	 * ************/
	public function clases($idCurso)
	{
		if(empty($idCurso)) return false;
		//Leemos los datos de la tabla
		$curso = $this->modelo->getId($idCurso);
		$tipoExamen = $this->modelo->getLlaves("tipoExamen");
		$data = $this->modelo->getClases($idCurso);
		$datos = [
			"titulo" => "Clases de: ".$curso["nombre"],
			"subtitulo" =>"Clases de: ".$curso["nombre"],
			"menu" => true,
			"admon" => "admon",
			"activo" => "cursos",
			"tipoExamen" => $tipoExamen,
			"curso" => $curso,
			"data" => $data
		];
		$this->vista("cursosClasesVista",$datos);
	}

	public function altaClase($id){
	  //Definir los arreglos
	  $data = array();
	  $errores = array();

	  //Recibimos la información de la vista
	  if ($_SERVER['REQUEST_METHOD']=="POST") {
		//
		$id = $_POST['id'] ?? "";
		//
		$idCurso = $_POST['idCurso'] ?? "";
		$idClase = $_POST['idClase'] ?? "";
		$tipo = $_POST['tipo'] ?? "void";
		$calificacion = $_POST['calificacion'] ?? "0";
		$observacion = $_POST['observacion'] ?? "";
		//
		// Validamos la información
		// 
		if(empty($idCurso)){
			array_push($errores,"La clave del curso es requerida.");
		}
		if(empty($id)){
			array_push($errores,"La clave de la clase es requerida.");
		}
		// Crear arreglo de datos
		//
		$data = [
		 "id" => $id,
		 "idCurso"=>$idCurso,
		 "tipo"=> $tipo,
		 "calificacion"=> $calificacion,
		 "observacion" => $observacion
		];
		//
		if (empty($errores)) {       
			//Modificacion
				if ($this->modelo->modificarClase($data)) {
					$this->mensaje(
						"Modificar una clase", 
						"Modificar una clase", 
						"Se modificó correctamente la clase.", 
						"cursos/clases/".$idCurso, 
						"success"
					);
				} else {
					$this->mensaje(
						"Error al modificar la clase", 
						"Error al modificar la clase", 
						"Error al modificar la clase.", 
						"cursos/clases/".$idCurso,
						"danger"
					);
				}
			}
		}
	}

	public function confirmarBorrarClase($id)
	{
	    $clase = $this->modelo->getClase($id);
	    $ir_array = $this->modelo->getIntegridadReferencialClase($id);

	    if ($ir_array["total"]==0) {
	    	if(count($clase)>0){
		    	$m = "Cuidado: Las clases para este curso <b>ya fueron creadas</b>. Si llega a borrar una clase y se pueden perder datos relacionados como calificaciones o asistencias.";
		    	$this->mensaje(
			  		"Borrar la clase", 
			  		"Borrar la clase", 
			  		$m, 
			  		"cursos/horario/".$clase["idCurso"],
			  		"danger",
			  		"cursos/bajaLogicaClase/".$id,
			  		"danger",
			  		"Borrar la clase"
			  	);
		    }
	    } else {
	    	$m = "No podemos eliminar la clase porque tiene:<ul>";
			foreach ($ir_array as $llave => $valor) {
				if ($valor>0 && $llave!="total") {
					$m.="<li>".$valor." ".$llave."</li>";
				}
			}
			$m.="</ul>Total: ".$ir_array["total"]." registros.<br><br>";
			$m.="Primero debe eliminar sus referencias.";
			$this->mensaje(
        		"Error al borrar la clase", 
        		"Error al borrar la clase", 
        		$m, 
        		"cursos", 
        		"danger"
        	);
	    }
	}

	public function bajaLogicaClase($id=''){
		if (isset($id) && $id!="") {
			if ($this->modelo->bajaLogicaClase($id)) {
				$this->mensaje(
					"Borrar una clase", 
					"Borrar una clase", 
					"Se borró correctamente la clase del curso.", 
					"cursos", 
					"success"
				);
			} else {
				$this->mensaje(
					"Error al borrar la clase del curso", 
					"Error al borrar la clase del curso", 
					"Error al borrar la clase del curso.", 
					"cursos", 
					"danger"
				);
			}
		}
	}

	public function crearClases($idCurso)
	{
		$curso = $this->modelo->getId($idCurso);
		$horarios = $this->modelo->getHorario($idCurso);
		$inicio = explode("-", $curso["fechaInicio"]);
		$final = explode("-", $curso["fechaFin"]);
		$diaSemana = $this->modelo->getLlaves("dia");
		$fechaInicial = mktime(0,0,0,$inicio[1],$inicio[2],$inicio[0]);
		$fechaFinal = mktime(0,0,0,$final[1],$final[2],$final[0]);
		//
		$clase_array = [];
		for($i=$fechaInicial; $i<=$fechaFinal; $i+=86400){
		    for ($ii=0; $ii < count($horarios); $ii++) { 
					if ($horarios[$ii]["dia"]==date('w', $i)) {
						array_push($clase_array, $i);
						break;
					}
				}
		}
		//
		$m = "Se crearán los registros de las clases para el curso: ".$curso["nombre"]."<br>";
		for($i=0; $i<count($clase_array); $i++){
			$m .= ($i+1).") ".date("d-m-Y", $clase_array[$i])."<br>";
		}
		$m .= "¿Desea crear las clases de este curso?<br>";
		//
		$this->mensaje(
	  		"Crear las clases del curso", 
	  		"Crear las clases del curso", 
	  		$m, 
	  		"cursos",
	  		"success",
	  		"cursos/crearRegistrosClases/".$idCurso,
	  		"success",
	  		"Crear clases"
	  	);
	}

	public function crearRegistrosClases($idCurso)
	{
		$curso = $this->modelo->getId($idCurso);
		$horarios = $this->modelo->getHorario($idCurso);
		$inicio = explode("-", $curso["fechaInicio"]);
		$final = explode("-", $curso["fechaFin"]);
		$diaSemana = $this->modelo->getLlaves("dia");
		$fechaInicial = mktime(0,0,0,$inicio[1],$inicio[2],$inicio[0]);
		$fechaFinal = mktime(0,0,0,$final[1],$final[2],$final[0]);
		//
		$clase_array = [];
		for($i=$fechaInicial; $i<=$fechaFinal; $i+=86400){
			for ($ii=0; $ii < count($horarios); $ii++) { 
				if ($horarios[$ii]["dia"]==date('w', $i)) {
					$clase = [
						"id"=>0,
						"idCurso"=>$idCurso,
						"fecha"=>date("Y-m-d", $i)
					];
					$this->modelo->crearClase($clase);
				}
			}
		}
		$this->mensaje(
			"Clases creadas", 
			"Clases creadas", 
			"Se crearon los registros de las clases del curso: ".$curso["nombre"], 
			"cursos/clases/".$idCurso, 
			"success"
		);
	}

	public function modificarClase($id)
	{
		$data = $this->modelo->getClase($id);
		$curso = $this->modelo->getId($data["idCurso"]);
		$tipoExamen = $this->modelo->getLlaves("tipoExamen");
		//
		$datos = [
			"titulo" => "Modificar una clase: ".$curso["nombre"],
			"subtitulo" => "Modificar una clase: ".$curso["nombre"],
			"activo" => "cursos",
			"menu" => true,
			"admon" => "admon",
			"tipoExamen"=>$tipoExamen,
			"curso"=>$curso,
			"errores" => [],
			"data" => $data
		];
		$this->vista("cursosClaseAltaVista",$datos);
	}
}
?>