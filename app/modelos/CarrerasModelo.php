<?php  
/**
 * 
 */
class CarrerasModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
	   $sql = "INSERT INTO carreras VALUES(0,"; //1. id 
	   $sql.= "'".$data['clave']."', ";          //2. clave
	   $sql.= "'".$data['descripcion']."', ";    //3. descripcion
	   //
	   $sql.= "0, ";                              //4. baja
	   $sql.= "null, ";                             //5. fecha baja
	   $sql.= "null, ";                             //6. fecha modificado 
	   $sql.= "NOW())";                          //7. fecha alta-creado
	   return $this->db->queryNoSelect($sql);
	 }


	public function bajaLogica($id){
		$salida = true;
		$sql = "UPDATE carreras SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT * FROM carreras WHERE baja=0";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM carreras WHERE baja=0 AND id=".$id;
		return $this->db->query($sql);
	}

	public function getNumRegistros()
	{
		//
		$sql = "SELECT COUNT(*) FROM carreras WHERE baja=0";
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function getCarrerasMaterias($id='')
	{
		$sql = "SELECT COUNT(*) FROM materias WHERE baja=0 AND idCarrera=".$id;
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE carreras SET "; 
	     $sql.= "clave='".$data['clave']."', ";
	     $sql.= "descripcion='".$data['descripcion']."', ";
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     //print $sql;
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
}
?>