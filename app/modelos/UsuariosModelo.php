<?php  
/**
 * 
 */
class UsuariosModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
	   $sql = "INSERT INTO usuarios VALUES(0,"; //1. id 
	   $sql.= "'".$data['tipo']."', ";          //2. tipo
	   $sql.= "'".$data['correo']."', ";    	//3. correo
	   $sql.= "'".$data['clave']."', ";     	//4. clave
	   $sql.= "'".$data['nombres']."', ";    	//5. nombres
	   $sql.= "'".$data['apellidoPaterno']."', ";    	//6. apellido paterno
	   $sql.= "'".$data['apellidoMaterno']."', ";    	//7. apellido materno
	   $sql.= "'".$data['genero']."', ";    	//8. genero
	   $sql.= "'".$data['telefono']."', ";    	//9. telefono
	   $sql.= "'".$data['pais']."', ";    		//10. pais
	   $sql.= "'".$data['ciudad']."', ";    	//11. ciudad
	   $sql.= "'".$data['codpos']."', ";    	//12. codigo postal
	   $sql.= "'".$data['foto']."', ";    		//13. foto
	   $sql.= "'".$data['fechaNacimiento']."', ";    		//14. fecha nacimieto
	   $sql.= "'".$data['tipoSangre']."', ";    //15. tipo Sangre
	   $sql.= "'".$data['estado']."', ";    	//16. estado

	   //
	   $sql.= "0, ";                              //17. baja
	   $sql.= "null, ";                             //18. login
	   $sql.= "null, ";                             //19. fecha baja
	   $sql.= "null, ";                             //20. fecha modificado 
	   $sql.= "NOW(),";                          //21. fecha alta-creado
	   $sql.= "0)";                          //22. calificacion
	   return $this->db->queryNoSelect($sql);
	 }


	public function bajaLogica($id){
		$salida = true;
		$sql = "UPDATE usuarios SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT u.id, u.tipo, u.nombres, u.apellidoPaterno, c.descripcion as tipoUsuario ";
		$sql.= "FROM usuarios as u, catalogos as c ";
		$sql.= "WHERE u.baja=0 AND c.tipo='tipoUsuario' AND c.clave=u.tipo ";
		$sql.= "ORDER BY u.id ";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM usuarios WHERE baja=0 AND id=".$id;
		return $this->db->query($sql);
	}

	public function getNumRegistros()
	{
		//
		$sql = "SELECT COUNT(*) FROM usuarios WHERE baja=0";
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function getCatalogo($tipo){
		$sql = "SELECT * FROM catalogos WHERE tipo='".$tipo."' ORDER BY clave";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function getIntegridadReferencial($id)
	{
		//
		$ir_array = [];
		$sql = "SELECT COUNT(*) FROM inscripciones WHERE idEstudiante=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Inscripciones"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM asistencias WHERE idEstudiante=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Asistencias"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM calificaciones WHERE idEstudiante=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Calificaciones"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM cursos WHERE baja=0 AND idProfesor=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Horarios"] = $salida["COUNT(*)"];
		//
		$ir_array["total"] = array_sum($ir_array);
		//
		return $ir_array;
	}


	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE usuarios SET "; 
	     $sql.= "tipo='".$data['tipo']."', ";
	     $sql.= "correo='".$data['correo']."', ";
	     $sql.= "nombres='".$data['nombres']."', ";
	     $sql.= "apellidoPaterno='".$data['apellidoPaterno']."', ";
	     $sql.= "apellidoMaterno='".$data['apellidoMaterno']."', ";
	     $sql.= "genero='".$data['genero']."', ";
	     $sql.= "telefono='".$data['telefono']."', ";
	     $sql.= "pais='".$data['pais']."', ";
	     $sql.= "ciudad='".$data['ciudad']."', ";
	     $sql.= "codpos='".$data['codpos']."', ";
	     $sql.= "foto='".$data['foto']."', ";
	     $sql.= "fechaNacimiento='".$data['fechaNacimiento']."', ";
	     $sql.= "tipoSangre='".$data['tipoSangre']."', ";
	     $sql.= "estado='".$data['estado']."', ";
	     //
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
}
?>