<?php  
/**
 * 
 */
class Materias extends Controlador
{
	private $modelo = "";
	private $admon;
	
	function __construct()
	{
		//Creamos sesion
		$sesion = new Sesion();
		if ($sesion->getLogin()) {
			$this->modelo = $this->modelo("MateriasModelo");
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
			"titulo"=> "Materias",
			"subtitulo" => "Materias",
			"admon" => $this->admon,
			"activo" => "materias",
			"data" => $data,
			"pag" => [
				"totalPaginas" => $totalPaginas,
				"regresa" => "materias",
				"pagina" => $pagina
			],
			"menu" => true
		];
		$this->vista("materiasCaratulaVista",$datos);
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
	      //
	      $clave = Helper::cadena($_POST['clave'] ?? "");
	      $nombre = Helper::cadena($_POST['nombre'] ?? "");
	      $idCarrera = Helper::cadena($_POST['idCarrera'] ?? "void");
	      //
	      // Validamos la información
	      // 
	      if(empty($nombre)){
	        array_push($errores,"El nombre de la materia es requerida.");
	      }
	      if(empty($clave)){
	        array_push($errores,"La clave de la materia es requerida.");
	      }
	      if($idCarrera=="void"){
	        array_push($errores,"La clave de la carrera es requerida.");
	      }

	      if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$data = [
			 "id" => $id,
			 "clave"=>$clave,
			 "nombre"=> $nombre,
			 "idCarrera" => $idCarrera,
			 "temario" => $temario
			];      
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->alta($data)) {
	            $this->mensaje(
	          		"Alta de la materia", 
	          		"Alta de la materia", 
	          		"Se añadió correctamente la materia: ".$nombre, 
	          		"materias", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir una materia.", 
	          		"Error al añadir una materia.", 
	          		"Error al modificar la materia: ".$nombre, 
	          		"materias", 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificar
	          if ($this->modelo->modificar($data)) {
	            $this->mensaje(
	          		"Modificar la materia", 
	          		"Modificar la materia", 
	          		"Se modificó correctamente la materia: ".$nombre, 
	          		"materias", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar una materia.", 
	          		"Error al modificar una materia.", 
	          		"Error al modificar la materia: ".$nombre, 
	          		"materias", 
	          		"danger"
	          	);
	          }
	        }
	      }
	    } 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Alta
	    	$carreras = $this->modelo->getCarreras();
		    $datos = [
		      "titulo" => "Alta de una materia",
		      "subtitulo" => "Alta de una materia",
		      "activo" => "materias",
		      "menu" => true,
		      "admon" => "admon",
		      "carreras" => $carreras,
		      "errores" => $errores,
		      "data" => []
		    ];
		    $this->vista("materiasAltaVista",$datos);
	    }
  	}

  	public function borrar($id=""){
	    //Leemos los datos del registro del id
	    $data = $this->modelo->getId($id);
	    $carreras = $this->modelo->getCarreras();
	    $numCursos = $this->modelo->getMateriasCursos($id);

	    if ($numCursos==0 || $numCursos=="") {
		    //Vista baja
		    $datos = [
		      "titulo" => "Baja de una materia",
		      "subtitulo" => "Baja de una materia",
		      "menu" => true,
		      "admon" => "admon",
		      "errores" => [],
		      "activo" => 'materias',
		      "carreras" => $carreras,
		      "data" => $data,
		      "baja" => true
		    ];
		    $this->vista("materiasAltaVista",$datos);
		} else {
			$this->mensaje(
        		"Error al borrar la materia", 
        		"Error al borrar la materia", 
        		"No podemos eliminar la materia porque tiene ".$numCursos." cursos relacionados. Primero debe eliminar los mismos.", 
        		"materias", 
        		"danger"
        	);
		}
	  }

  public function bajaLogica($id=''){
	   if (isset($id) && $id!="") {
	     if ($this->modelo->bajaLogica($id)) {
        	$this->mensaje(
        		"Borrar la materia", 
        		"Borrar la materia", 
        		"Se borró correctamente la materia.", 
        		"materias", 
        		"success"
        	);
        } else {
        	$this->mensaje(
        		"Error al borrar la materia", 
        		"Error al borrar la materia", 
        		"Error al borrar la materia.", 
        		"materias", 
        		"danger"
        	);
        }
	   }
	}

  	public function modificar($id)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getId($id);
		$carreras = $this->modelo->getCarreras();

		$datos = [
			"titulo" => "Modificar materia",
			"subtitulo" =>"Modificar materia",
			"menu" => true,
			"admon" => "admon",
			"activo" => "materias",
			"carreras" => $carreras,
			"data" => $data
		];
		$this->vista("materiasAltaVista",$datos);
	}
}

?>