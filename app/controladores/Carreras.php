<?php  
/**
 * 
 */
class Carreras extends Controlador
{
	private $modelo = "";
	private $admon;
	
	function __construct()
	{
		//Creamos sesion
		$sesion = new Sesion();
		if ($sesion->getLogin()) {
			$this->modelo = $this->modelo("CarrerasModelo");
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
			"titulo"=> "Carreras",
			"subtitulo" => "Carreras",
			"admon" => $this->admon,
			"activo" => "carreras",
			"data" => $data,
			"pag" => [
				"totalPaginas" => $totalPaginas,
				"regresa" => "carreras",
				"pagina" => $pagina
			],
			"menu" => true
		];
		$this->vista("carrerasCaratulaVista",$datos);
	}

	public function alta(){
	   //Definir los arreglos
	    $data = array();
	    $errores = array();

	    //Recibimos la información de la vista
	    if ($_SERVER['REQUEST_METHOD']=="POST") {
	      //
	      $id = $_POST['id'] ?? "";
	      //
	      $clave = Helper::cadena($_POST['clave'] ?? "");
	      $descripcion = Helper::cadena($_POST['descripcion'] ?? "");
	      //
	      // Validamos la información
	      // 
	      if(empty($descripcion)){
	        array_push($errores,"La descripción de la carrera es requerida.");
	      }
	      if(empty($clave)){
	        array_push($errores,"La clave de la carrera es requerida.");
	      }

	      if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$data = [
			 "id" => $id,
			 "clave"=>$clave,
			 "descripcion"=> $descripcion
			];      
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->alta($data)) {
	            $this->mensaje(
	          		"Alta de la carrera", 
	          		"Alta de la carrera", 
	          		"Se añadió correctamente la carrera: ".$descripcion, 
	          		"carreras", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir una carrera.", 
	          		"Error al añadir una carrera.", 
	          		"Error al modificar la carrera: ".$descripcion, 
	          		"carreras", 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificar
	          if ($this->modelo->modificar($data)) {
	            $this->mensaje(
	          		"Modificar la carrera", 
	          		"AModificar la carrera", 
	          		"Se modificó correctamente la carrera: ".$descripcion, 
	          		"carreras", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar una carrera.", 
	          		"Error al modificar una carrera.", 
	          		"Error al modificar la carrera: ".$descripcion, 
	          		"carreras", 
	          		"danger"
	          	);
	          }
	        }
	      }
	    } 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Alta
		    $datos = [
		      "titulo" => "Alta de una carrera",
		      "subtitulo" => "Alta de una carrera",
		      "activo" => "carreras",
		      "menu" => true,
		      "admon" => "admon",
		      "errores" => $errores,
		      "data" => []
		    ];
		    $this->vista("carrerasAltaVista",$datos);
	    }
  	}

  	public function borrar($id=""){
	    //Leemos los datos del registro del id
	    $data = $this->modelo->getId($id);
	    $numMaterias = $this->modelo->getCarrerasMaterias($id);

	    if ($numMaterias==0 || $numMaterias=="") {
	    	//Vista baja
		    $datos = [
		      "titulo" => "Baja de una carrera",
		      "subtitulo" => "Baja de una carrera",
		      "menu" => true,
		      "admon" => "admon",
		      "errores" => [],
		      "activo" => 'carreras',
		      "data" => $data,
		      "baja" => true
		    ];
		    $this->vista("carrerasAltaVista",$datos);
	    } else {
	    	$this->mensaje(
        		"Error al borrar la carrera", 
        		"Error al borrar la carrera", 
        		"No podemos eliminar la carrera porque tiene ".$numMaterias." materias relacionadas. Primero debe eliminar las mismas.", 
        		"carreras", 
        		"danger"
        	);
	    }
	}

  public function bajaLogica($id=''){
	   if (isset($id) && $id!="") {
	     if ($this->modelo->bajaLogica($id)) {
        	$this->mensaje(
        		"Borrar la carrera", 
        		"Borrar la carrera", 
        		"Se borró correctamente la carrera.", 
        		"carreras", 
        		"success"
        	);
        } else {
        	$this->mensaje(
        		"Error al borrar la carrera", 
        		"Error al borrar la carrera", 
        		"Error al borrar la carrera.", 
        		"carreras", 
        		"danger"
        	);
        }
	   }
	}

  	public function modificar($id)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getId($id);

		$datos = [
			"titulo" => "Modificar carrera",
			"subtitulo" =>"Modificar carrera",
			"menu" => true,
			"admon" => "admon",
			"activo" => "carreras",
			"data" => $data
		];
		$this->vista("carrerasAltaVista",$datos);
	}
}

?>