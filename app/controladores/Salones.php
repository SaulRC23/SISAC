<?php  
/**
 * 
 */
class Salones extends Controlador
{
	private $modelo = "";
	private $admon;
	
	function __construct()
	{
		//Creamos sesion
		$sesion = new Sesion();
		if ($sesion->getLogin()) {
			$this->modelo = $this->modelo("SalonesModelo");
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
			"titulo"=> "Salones",
			"subtitulo" => "Salones",
			"admon" => $this->admon,
			"activo" => "salones",
			"data" => $data,
			"pag" => [
				"totalPaginas" => $totalPaginas,
				"regresa" => "salones",
				"pagina" => $pagina
			],
			"menu" => true
		];
		$this->vista("salonesCaratulaVista",$datos);
	}

	public function alta(){
	   //Definir los arreglos
	    $data = array();
	    $errores = array();

	    //Recibimos la información de la vista
	    if ($_SERVER['REQUEST_METHOD']=="POST") {
	      //
	      $id = $_POST['id'] ?? "";
	      $clave = Helper::cadena($_POST['clave'] ?? "");
	      $descripcion = Helper::cadena($_POST['descripcion'] ?? "");
	      $nota = Helper::cadena($_POST['nota'] ?? "");
	      //
	      // Validamos la información
	      // 
	      if(empty($descripcion)){
	        array_push($errores,"La descripción del salón es requerida.");
	      }
	      if(empty($clave)){
	        array_push($errores,"La clave del salón es requerida.");
	      }

	      if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$data = [
			 "id" => $id,
			 "clave"=>$clave,
			 "descripcion"=> $descripcion,
			 "nota" => $nota
			];      
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->alta($data)) {
	            $this->mensaje(
	          		"Alta de un salón", 
	          		"Alta de un salón", 
	          		"Se añadió correctamente el salón: ".$descripcion, 
	          		"salones", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir un salón.", 
	          		"Error al añadir un salón.", 
	          		"Error al modificar un salón: ".$descripcion, 
	          		"salones", 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificar
	          if ($this->modelo->modificar($data)) {
	            $this->mensaje(
	          		"Modificar el salón", 
	          		"Modificar el salón", 
	          		"Se modificó correctamente el salón: ".$descripcion,
	          		"salones", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar el salón.", 
	          		"Error al modificar el salón.", 
	          		"Error al modificar el salón: ".$descripcion, 
	          		"salones", 
	          		"danger"
	          	);
	          }
	        }
	      }
	    } 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Alta
		    $datos = [
		      "titulo" => "Alta de un salón",
		      "subtitulo" => "Alta de un salón",
		      "activo" => "salones",
		      "menu" => true,
		      "admon" => "admon",
		      "errores" => $errores,
		      "data" => []
		    ];
		    $this->vista("salonesAltaVista",$datos);
	    }
  	}

  	public function borrar($id=""){
	    //Leemos los datos del registro del id
	    $data = $this->modelo->getId($id);
	    $ir_array = $this->modelo->getIntegridadReferencial($id);

	    if ($ir_array[0]==0) {
	    	//Vista baja
		    $datos = [
		      "titulo" => "Baja de un salón",
		      "subtitulo" => "Baja de el salón",
		      "menu" => true,
		      "admon" => "admon",
		      "errores" => [],
		      "activo" => 'salones',
		      "data" => $data,
		      "baja" => true
		    ];
		    $this->vista("salonesAltaVista",$datos);
	    } else {
	    	$this->mensaje(
        		"Error al borrar el salón", 
        		"Error al borrar el salón", 
        		"No podemos eliminar el salón porque tiene:<ul><li>".$ir_array[1]." cursos.</li><li>".$ir_array[2]." horarios.</li></ul>Primero debe eliminar esas referencias.", 
        		"salones", 
        		"danger"
        	);
	    }
	  }

  public function bajaLogica($id=''){
	   if (isset($id) && $id!="") {
	     if ($this->modelo->bajaLogica($id)) {
        	$this->mensaje(
        		"Borrar el salón", 
        		"Borrar el salón", 
        		"Se borró correctamente el salón.", 
        		"salones", 
        		"success"
        	);
        } else {
        	$this->mensaje(
        		"Error al borrar el salón", 
        		"Error al borrar el salón", 
        		"Error al borrar el salón.", 
        		"salones", 
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
			"titulo" => "Modificar salón",
			"subtitulo" =>"Modificar salón",
			"menu" => true,
			"admon" => "admon",
			"activo" => "salones",
			"data" => $data
		];
		$this->vista("salonesAltaVista",$datos);
	}
}

?>