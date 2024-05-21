<?php  
/**
 * 
 */
class SalonesModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
	   $sql = "INSERT INTO salones VALUES(0,"; //1. id 
	   $sql.= "'".$data['clave']."', ";          //2. clave
	   $sql.= "'".$data['descripcion']."', ";    //3. nombre
	   $sql.= "'".$data['nota']."', ";     		//4. carrera
	   //
	   $sql.= "0, ";                              //5. baja
	   $sql.= "null, ";                             //6. fecha baja
	   $sql.= "null, ";                             //7. fecha modificado 
	   $sql.= "NOW())";                          //8. fecha alta-creado
	   return $this->db->queryNoSelect($sql);
	 }


	public function bajaLogica($id){
		$salida = true;
		$sql = "UPDATE salones SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT id, clave, descripcion, nota ";
		$sql.= "FROM salones ";
		$sql.= "WHERE baja=0";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM salones WHERE baja=0 AND id=".$id;
		return $this->db->query($sql);
	}

	public function getNumRegistros()
	{
		//
		$sql = "SELECT COUNT(*) FROM salones WHERE baja=0";
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function getIntegridadReferencial($id)
	{
		//
		$ir_array = [0,0,0];
		$sql = "SELECT COUNT(*) FROM cursos WHERE baja=0 AND idSalon=".$id;
		$salida = $this->db->query($sql);
		$ir_array[1] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM horarios WHERE baja=0 AND idSalon=".$id;
		$salida = $this->db->query($sql);
		$ir_array[2] = $salida["COUNT(*)"];
		//
		$ir_array[0] = $ir_array[1] + $ir_array[2];
		//
		return $ir_array;
	}

	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE salones SET "; 
	     $sql.= "clave='".$data['clave']."', ";
	     $sql.= "descripcion='".$data['descripcion']."', ";
	     $sql.= "nota='".$data['nota']."', ";
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
}
?>