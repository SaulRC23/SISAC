<?php  
/**
 * 
 */
class Materiales extends Controlador
{
	private $modelo = "";
	private $admon;
	
	function __construct()
	{
		//Creamos sesion
		$sesion = new Sesion();
		if ($sesion->getLogin()) {
			$this->modelo = $this->modelo("MaterialesModelo");
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
			"titulo"=> "Materiales",
			"subtitulo" => "Materiales",
			"admon" => $this->admon,
			"activo" => "materiales",
			"data" => $data,
			"pag" => [
				"totalPaginas" => $totalPaginas,
				"regresa" => "materiales",
				"pagina" => $pagina
			],
			"menu" => true
		];
		$this->vista("materialesCaratulaVista",$datos);
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
	      $referencia = Helper::cadena($_POST['referencia'] ?? "");
	      $tipoMaterial = $_POST['tipoMaterial'] ?? "void";
	      //
	      // Validamos la información
	      // 
	      if(empty($descripcion)){
	        array_push($errores,"La descripción del material es requerida.");
	      }
	      if(empty($clave)){
	        array_push($errores,"La clave del material es requerida.");
	      }
	      if($tipoMaterial=="void"){
	        array_push($errores,"El tipo de material es requerido.");
	      }

	      if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$data = [
			 "id" => $id,
			 "clave"=>$clave,
			 "tipoMaterial"=> $tipoMaterial,
			 "descripcion"=> $descripcion,
			 "referencia" => $referencia
			];      
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->alta($data)) {
	            $this->mensaje(
	          		"Alta de un material", 
	          		"Alta de un material", 
	          		"Se añadió correctamente el material: ".$descripcion, 
	          		"materiales", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir un material.", 
	          		"Error al añadir un material.", 
	          		"Error al modificar un material: ".$descripcion, 
	          		"materiales", 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificar
	          if ($this->modelo->modificar($data)) {
	            $this->mensaje(
	          		"Modificar el material", 
	          		"Modificar el material", 
	          		"Se modificó correctamente el material: ".$descripcion,
	          		"materiales", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar el material.", 
	          		"Error al modificar el material.", 
	          		"Error al modificar el material: ".$descripcion, 
	          		"materiales", 
	          		"danger"
	          	);
	          }
	        }
	      }
	    } 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Alta
	    	$tipoMaterial = $this->modelo->getCatalogo("tipoMaterial");
		    $datos = [
		      "titulo" => "Alta de un material",
		      "subtitulo" => "Alta de un material",
		      "activo" => "materiales",
		      "menu" => true,
		      "admon" => "admon",
		      "tipoMaterial" => $tipoMaterial,
		      "errores" => $errores,
		      "data" => []
		    ];
		    $this->vista("materialesAltaVista",$datos);
	    }
  	}

  	public function borrar($id=""){
	    //Leemos los datos del registro del id
	    $data = $this->modelo->getId($id);
	    $tipoMaterial = $this->modelo->getCatalogo("tipoMaterial");

	    //Vista baja
	    $datos = [
	      "titulo" => "Baja de un material",
	      "subtitulo" => "Baja de un material",
	      "menu" => true,
	      "admon" => "admon",
	      "errores" => [],
	      "activo" => 'materiales',
	      "tipoMaterial" => $tipoMaterial,
	      "data" => $data,
	      "baja" => true
	    ];
	    $this->vista("materialesAltaVista",$datos);
	  }

  public function bajaLogica($id=''){
	   if (isset($id) && $id!="") {
	     if ($this->modelo->bajaLogica($id)) {
        	$this->mensaje(
        		"Borrar el material", 
        		"Borrar el material", 
        		"Se borró correctamente el material.", 
        		"materiales", 
        		"success"
        	);
        } else {
        	$this->mensaje(
        		"Error al borrar el material", 
        		"Error al borrar el material", 
        		"Error al borrar el material.", 
        		"materiales", 
        		"danger"
        	);
        }
	   }
	}

  	public function modificar($id)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getId($id);
		$tipoMaterial = $this->modelo->getCatalogo("tipoMaterial");
		$datos = [
			"titulo" => "Modificar material",
			"subtitulo" =>"Modificar material",
			"menu" => true,
			"admon" => "admon",
			"tipoMaterial" => $tipoMaterial,
			"activo" => "materiales",
			"data" => $data
		];
		$this->vista("materialesAltaVista",$datos);
	}
}

?>