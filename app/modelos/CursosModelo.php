<?php  
/**
 * 
 */
class CursosModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function alta($data){
	   $sql = "INSERT INTO cursos VALUES(0,"; //1. id 
	   $sql.= "'".$data['clave']."', ";          //2. clave
	   $sql.= "'".$data['nombre']."', ";    	//3. nombre
	   $sql.= "'".$data['temario']."', ";    	//4. temario
	   $sql.= "'".$data['idSalon']."', ";     	//5. idSalon
	   $sql.= "'".$data['idProfesor']."', ";    //6. idProfesor
	   $sql.= "'".$data['idMateria']."', ";     //7. idMateria
	   $sql.= "'".$data['fechaInicio']."', ";   //8. fechaInicio
	   $sql.= "'".$data['fechaFin']."', ";     	//9. fechaFin
	   //
	   $sql.= "0, ";                              //10. baja
	   $sql.= "null, ";                             //11. fecha baja
	   $sql.= "null, ";                             //12. fecha modificado 
	   $sql.= "NOW())";                          //13. fecha alta-creado
	   return $this->db->queryNoSelect($sql);
	 }

	public function bajaLogica($id){
		$salida = true;
		$sql = "UPDATE cursos SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function getTabla($inicio=1, $tamano=0)
	{
		$sql = "SELECT * ";
		$sql.= "FROM cursos ";
		$sql.= "WHERE baja=0";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
		return $this->db->querySelect($sql);
	}

	public function getId($id)
	{
		$sql = "SELECT * FROM cursos WHERE baja=0 AND id=".$id;
		return $this->db->query($sql);
	}

	public function getCatalogo($tipo)
	{
		$sql = "SELECT * FROM catalogos WHERE tipo='".$tipo."' ORDER BY clave";
		return $this->db->querySelect($sql);
	}

	public function getSalones(){
		$sql = "SELECT * FROM salones WHERE baja=0";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function getProfesores(){
		$sql = "SELECT * FROM usuarios WHERE baja=0 AND tipo=2";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function getMaterias(){
		$sql = "SELECT * FROM materias WHERE baja=0";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function getLlaves($tipo){
		$sql = "SELECT * FROM catalogos WHERE tipo='".$tipo."'";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function getNumRegistros()
	{
		//
		$sql = "SELECT COUNT(*) FROM cursos WHERE baja=0";
		$salida = $this->db->query($sql);
		return $salida["COUNT(*)"];
	}

	public function getIntegridadReferencial($id)
	{
		//
		$ir_array = [];
		$sql = "SELECT COUNT(*) FROM inscripciones WHERE idCurso=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Inscripciones"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM clases WHERE baja=0 AND idCurso=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Clases"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM asistencias WHERE idCurso=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Asistencias"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM calificaciones WHERE idCurso=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Calificaciones"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM horarios WHERE baja=0 AND idCurso=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Horarios"] = $salida["COUNT(*)"];
		//
		$ir_array["total"] = array_sum($ir_array);
		//
		return $ir_array;
	}

	public function getIntegridadReferencialClase($id)
	{
		//
		$ir_array = [];
		//
		$sql = "SELECT COUNT(*) FROM asistencias WHERE idClase=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Asistencias"] = $salida["COUNT(*)"];
		//
		$sql = "SELECT COUNT(*) FROM calificaciones WHERE idClase=".$id;
		$salida = $this->db->query($sql);
		$ir_array["Calificaciones"] = $salida["COUNT(*)"];
		//
		$ir_array["total"] = array_sum($ir_array);
		//
		return $ir_array;
	}

	public function modificar($data='')
	{
		$salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE cursos SET "; 
	     $sql.= "clave='".$data['clave']."', ";
	     $sql.= "nombre='".$data['nombre']."', ";
	     $sql.= "temario='".$data['temario']."', ";
	     $sql.= "idSalon='".$data['idSalon']."', ";
	     $sql.= "idProfesor='".$data['idProfesor']."', ";
	     $sql.= "idMateria='".$data['idMateria']."', ";
	     $sql.= "fechaInicio='".$data['fechaInicio']."', ";
	     $sql.= "fechaFin='".$data['fechaFin']."', ";
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}
	/*****************
	 * HORARIOS
	 * ***************/
	public function getIdHorario($id){
		$sql = "SELECT * FROM horarios WHERE id=".$id;
	    $data = $this->db->query($sql);
	    return $data;
	}

	public function getHorario($id){
		$sql = "SELECT h.id, h.idCurso, h.idSalon, h.dia, h.horaInicio, h.horaFin, ";
		$sql .= "c.descripcion as diaCadena ";
		$sql .= "FROM horarios as h, catalogos as c ";
		$sql .= "WHERE h.idCurso=".$id." AND c.tipo='dia' AND c.clave=h.dia AND h.baja=0 ";
		$sql .= "ORDER BY h.dia, h.horaInicio";
	    $data = $this->db->querySelect($sql);
	    return $data;
	}

	public function altaHorario($data){
	   $sql = "INSERT INTO horarios VALUES(0,";   //1. id 
	   $sql.= "'".$data['idCurso']."', ";       //2. clave
	   $sql.= "'".$data['idSalon']."', ";    	//3. nombre
	   $sql.= "'".$data['dia']."', ";    	    //4. temario
	   $sql.= "'".$data['horaInicio']."', ";    //5. idSalon
	   $sql.= "'".$data['horaFin']."', ";        //6. idProfesor
	   $sql.= "'".$data['observacion']."', ";    //7. Observacion
	   //
	   $sql.= "0, ";                              //8. baja
	   $sql.= "null, ";                             //9. fecha baja
	   $sql.= "null, ";                             //10. fecha modificado 
	   $sql.= "NOW())";                           //11. fecha alta-creado
	   return $this->db->queryNoSelect($sql);
	}

	public function bajaLogicaHorario($id){
		$salida = true;
		$sql = "UPDATE horarios SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}

	public function modificarHorario($data){
		$salida = false;
		if (!empty($data["id"])) {
			$sql = "UPDATE horarios SET "; 
			$sql.= "idCurso='".$data['idCurso']."', ";
			$sql.= "idSalon='".$data['idSalon']."', ";
			$sql.= "dia='".$data['dia']."', ";
			$sql.= "horaInicio='".$data['horaInicio']."', ";
			$sql.= "horaFin='".$data['horaFin']."', ";
			$sql.= "modificado_dt=(NOW()) ";
			$sql.= "WHERE id=".$data['id'];
			//Enviamos a la base de datos
			$salida = $this->db->queryNoSelect($sql);
		}
		return $salida;
	}

	/**************
	 * Clases
	 * ***********/
	public function getClases($idCurso)
	{
		$sql = "SELECT * FROM clases WHERE baja=0 AND idCurso=".$idCurso;
	    $data = $this->db->querySelect($sql);
	    return $data;
	}
	public function crearClase($data)
	{
		$sql = "INSERT INTO clases VALUES(0,";  //1. id 
		$sql.= "'".$data['idCurso']."', ";      //2. clave
		$sql.= "'".$data['fecha']."', ";    	//3. nombre
		$sql.= "'', ";   						//4. observación
		$sql.= "0, ";   						//5. tipoExamen
		$sql.= "0, ";   						//6. calificacion
		//
		$sql.= "0, ";                           //7. baja
		$sql.= "null, ";                          //8. fecha baja
		$sql.= "null, ";                          //9. fecha modificado 
		$sql.= "NOW())";                        //10. fecha alta-creado
		return $this->db->queryNoSelect($sql);
	}

	public function getClase($id)
	{
		$sql = "SELECT * FROM clases WHERE id=".$id;
	    $data = $this->db->query($sql);
	    return $data;
	}

	public function modificarClase($data){
	    $salida = false;
	    if (!empty($data["id"])) {
	     $sql = "UPDATE clases SET "; 
	     $sql.= "tipoExamen='".$data['tipo']."', ";
	     $sql.= "calificacion='".$data['calificacion']."', ";
	     $sql.= "observacion='".$data['observacion']."', ";
	     $sql.= "modificado_dt=(NOW()) ";
	     $sql.= "WHERE id=".$data['id'];
	     //Enviamos a la base de datos
	     $salida = $this->db->queryNoSelect($sql);
	    }
	    return $salida;
	}

	public function bajaLogicaClase($id){
		$salida = true;
		$sql = "UPDATE clases SET baja=1, baja_dt=(NOW()) WHERE id=".$id;
		$salida = $this->db->queryNoSelect($sql);
		return $salida;
	}
}
?>