<?php  
/**
 * 
 */
class MaterialesModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
		$sql = "INSERT INTO materiales VALUES(0,";
		$sql.= "'".$data['clave']."', ";                   //1. clave
		$sql.= "'".$data['tipoMaterial']."', ";            //2. tipoMaterial
		$sql.= "'".$data['descripcion']."', ";             //3. descripcion
		$sql.= "0, ";                                      //4. baja
		$sql.= "null, ";                                   //5. fecha baja
		$sql.= "null, ";                                   //6. fecha modificado 
		$sql.= "NOW(), ";                                  //7. fecha alta-creado
		$sql.= "'".$data['referencia']."')";               //8. referencia
		return $this->db->queryNoSelect($sql);
	}
	 
	public function bajaLogica($id){
		$salida = true;
		$sql = "UPDATE materiales SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT m.id, m.clave, m.tipoMaterial as tipo, m.descripcion, c.descripcion as tipoMaterial ";
		$sql.= "FROM materiales as m, catalogos as c ";
		$sql.= "WHERE m.baja=0 AND c.tipo='tipoMaterial' AND m.tipoMaterial=c.clave";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM materiales WHERE baja=0 AND id=".$id;
		return $this->db->query($sql);
	}

	public function getCatalogo($tipo)
	{
		$sql = "SELECT * FROM catalogos WHERE tipo='".$tipo."' ORDER BY clave";
		return $this->db->querySelect($sql);
	}

	public function getNumRegistros()
	{
		//
		$sql = "SELECT COUNT(*) FROM materiales WHERE baja=0";
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE materiales SET "; 
	     $sql.= "clave='".$data['clave']."', ";
	     $sql.= "descripcion='".$data['descripcion']."', ";
	     $sql.= "referencia='".$data['referencia']."', ";
	     $sql.= "tipoMaterial='".$data['tipoMaterial']."', ";
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
}
?>