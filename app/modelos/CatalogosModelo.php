<?php  
/**
 * 
 */
class CatalogosModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
	   $sql = "INSERT INTO catalogos VALUES(0,"; //1. id 
	   $sql.= "'".$data['tipo']."', ";          //2. clave
	   $sql.= "'".$data['clave']."', ";    		//3. nombre
	   $sql.= "'".$data['descripcion']."')";     //4. carrera
	   return $this->db->queryNoSelect($sql);
	 }


	public function bajaLogica($id){
		$salida = true;
		$sql = "DELETE FROM catalogos WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT tipo, count(*) as num FROM `catalogos` GROUP BY tipo ORDER BY tipo";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getTipo($tipo){
		$sql = "SELECT * FROM `catalogos` WHERE tipo='".$tipo."' ORDER BY clave";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function getNumLlaves($tipo){
		$sql = "SELECT count(*) FROM catalogos WHERE tipo='".$tipo."'";
	    $data = $this->db->query($sql);
	    if ($data["count(*)"]) {
	    	return $data["count(*)"]+1;
	    }
	    return 0;
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM catalogos WHERE id=".$id;
		return $this->db->query($sql);
	}

	public function getNumRegistros(){
		$sql = "SELECT count(*) FROM catalogos";
	    $data = $this->db->query($sql);
	    if ($data["count(*)"]) {
	    	return $data["count(*)"];
	    }
	    return 0;
	}

	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE catalogos SET "; 
	     $sql.= "tipo='".$data['tipo']."', ";
	     $sql.= "clave='".$data['clave']."', ";
	     $sql.= "descripcion='".$data['descripcion']."' ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
}
?>