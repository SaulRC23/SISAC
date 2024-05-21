<?php  
/**
 * 
 */
class MateriasModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
	   $sql = "INSERT INTO materias VALUES(0,"; //1. id 
	   $sql.= "'".$data['clave']."', ";          //2. clave
	   $sql.= "'".$data['nombre']."', ";    	//3. nombre
	   $sql.= "'".$data['idCarrera']."', ";     //4. carrera
	   $sql.= "'".$data['temario']."', ";    	//5. temario
	   //
	   $sql.= "0, ";                              //6. baja
	   $sql.= "null, ";                             //7. fecha baja
	   $sql.= "null, ";                             //8. fecha modificado 
	   $sql.= "NOW())";                          //9. fecha alta-creado
	   return $this->db->queryNoSelect($sql);
	 }


	public function bajaLogica($id){
		$salida = true;
		$sql = "UPDATE materias SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT m.id, m.clave, m.nombre, c.descripcion as carrera ";
		$sql.= "FROM materias as m, carreras as c ";
		$sql.= "WHERE m.baja=0 AND m.idCarrera=c.id";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM materias WHERE baja=0 AND id=".$id;
		return $this->db->query($sql);
	}

	public function getNumRegistros()
	{
		//
		$sql = "SELECT COUNT(*) FROM materias WHERE baja=0";
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function getMateriasCursos($id='')
	{
		$sql = "SELECT COUNT(*) FROM cursos WHERE baja=0 AND idMateria=".$id;
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function getCarreras(){
		$sql = "SELECT id, descripcion FROM carreras WHERE baja=0 ORDER BY clave";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE materias SET "; 
	     $sql.= "clave='".$data['clave']."', ";
	     $sql.= "nombre='".$data['nombre']."', ";
	     $sql.= "idCarrera='".$data['idCarrera']."', ";
	     $sql.= "temario='".$data['temario']."', ";
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
}
?>