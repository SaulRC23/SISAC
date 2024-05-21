<?php  
/**
 * 
 */
class Catalogos extends Controlador
{
	private $modelo = "";
	private $admon;
	
	function __construct()
	{
		//Creamos sesion
		$sesion = new Sesion();
		if ($sesion->getLogin()) {
			$this->modelo = $this->modelo("CatalogosModelo");
			$this->admon = $sesion->getAdmon();
		} else {
			header("location:".RUTA);
		}
		
		
	}

	public function caratula($pagina=1)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getTabla();

		$datos = [
			"titulo"=> "Catálogos",
			"subtitulo" => "Catálogos",
			"admon" => $this->admon,
			"activo" => "catalogos",
			"data" => $data,
			"menu" => true
		];
		$this->vista("catalogosCaratulaVista",$datos);
	}

	public function alta($tipo){
	   //Definir los arreglos
	    $data = array();
	    $errores = array();

	    //Recibimos la información de la vista
	    if ($_SERVER['REQUEST_METHOD']=="POST") {
	      //
		  $id = $_POST['id'] ?? "";
	      //
	      $descripcion = Helper::cadena($_POST['descripcion'] ?? "");
	      $tipo = Helper::cadena($_POST['tipo2'] ?? "");
	      $clave = Helper::cadena($_POST['clave2'] ?? "");
	      //
	      // Validamos la información
	      // 
	      if(empty($descripcion)){
	        array_push($errores,"La descripción de la llave es requerida.");
	      }
	      if(empty($clave)){
	        array_push($errores,"La clave de la llave es requerida.");
	      }
	      if(empty($tipo)){
	        array_push($errores,"El tipo de la llave es requerida.");
	      }

	      if (empty($errores)) { 
			// Crear arreglo de datos
			//
			$data = [
			 "id" => $id,
			 "clave"=>$clave,
			 "descripcion"=> $descripcion,
			 "tipo" => $tipo
			];      
	        //Enviamos al modelo
	        if(trim($id)===""){
	          //Alta
	          if ($this->modelo->alta($data)) {
	            $this->mensaje(
	          		"Alta de la llave", 
	          		"Alta de la llave", 
	          		"Se añadió correctamente la llave: ".$data["descripcion"], 
	          		"catalogos", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al añadir una llave.", 
	          		"Error al añadir una llave.", 
	          		"Error al añadir la llave: ".$data["descripcion"], 
	          		"catalogos", 
	          		"danger"
	          	);
	          }
	        } else {
	          //Modificar
	          if ($this->modelo->modificar($data)) {
	            $this->mensaje(
	          		"Modificar la llave", 
	          		"Modificar la llave", 
	          		"Se modificó correctamente la llave: ".$data["descripcion"], 
	          		"catalogos", 
	          		"success"
	          	);
	          } else {
	          	$this->mensaje(
	          		"Error al modificar una llave.", 
	          		"Error al modificar una llave.", 
	          		"Error al modificar la llave: ".$data["descripcion"], 
	          		"catalogos", 
	          		"danger"
	          	);
	          }
	        }
	      }
	    } 
	    if(!empty($errores) || $_SERVER['REQUEST_METHOD']!="POST" ){
	    	//Vista Alta
	    	$clave = $this->modelo->getNumLlaves($tipo);
		    $datos = [
		      "titulo" => "Alta de una llave",
		      "subtitulo" => "Alta de una llave",
		      "activo" => "catalogos",
		      "menu" => true,
		      "admon" => "admon",
		      "errores" => $errores,
		      "data" => ["clave"=>$clave,"tipo"=>$tipo]
		    ];
		    $this->vista("catalogosAltaVista",$datos);
	    }
  	}

  	public function borrar($id=""){
		//Leemos los datos del registro del id
		$data = $this->modelo->getId($id);

		//Vista baja
		$datos = [
		  "titulo" => "Baja de una llave",
		  "subtitulo" => "Baja de una llave",
		  "menu" => true,
		  "admon" => "admon",
		  "errores" => [],
		  "activo" => 'catalogos',
		  "data" => $data,
		  "baja" => true
		];
		$this->vista("catalogosAltaVista",$datos);
	}

	public function bajaLogica($id=''){
	   if (isset($id) && $id!="") {
			if ($this->modelo->bajaLogica($id)) {
				$this->mensaje(
					"Borrar la llave", 
					"Borrar la llave", 
					"Se borró correctamente la llave.", 
					"catalogos", 
					"success"
				);
			} else {
				$this->mensaje(
					"Error al borrar la llave", 
					"Error al borrar la llave", 
					"Error al borrar la llave.", 
					"catalogos", 
					"danger"
				);
			}
	   }
	}

	public function mostrar($tipo)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getTipo($tipo);

		$datos = [
			"titulo" => "Catálogo ".$tipo,
			"subtitulo" => "Catálogo ".$tipo,
			"menu" => true,
			"admon" => "admon",
			"activo" => "catalogos",
			"data" => $data
		];
		$this->vista("catalogosTipoVista",$datos);
	}

	public function cambiar($id)
	{
		//Leemos los datos de la tabla
		$data = $this->modelo->getId($id);
		$datos = [
			"titulo" => "Modificar catálogo ",
			"subtitulo" => "Modificar catálogo ",
			"menu" => true,
			"admon" => "admon",
			"activo" => "catalogos",
			"data" => $data
		];
		$this->vista("catalogosAltaVista",$datos);
	}
}

?>