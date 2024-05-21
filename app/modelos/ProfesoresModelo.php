<?php  
/**
 * 
 */
class ProfesoresModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function getCursosProfesor($id){
		$sql = "SELECT * ";
		$sql.= "FROM cursos ";
		$sql.= "WHERE idProfesor=".$id." ";
		$sql.= "ORDER BY fechaInicio ";
		$data = $this->db->querySelect($sql);
		return $data;
	}

	public function getUsuarioId($id){
		$sql = "SELECT * FROM usuarios WHERE id=".$id." AND baja=0";
		$data = $this->db->query($sql);
		return $data;
	}

	public function getCatalogos($tipo='')
	{
		$sql = "SELECT * FROM catalogos WHERE tipo='".$tipo."' ORDER BY clave";
		return $this->db->querySelect($sql);
	}

	/*****************************
	 * I N S C R I P C I O N E S
	 * ***************************/
	public function getNumEstudiantes($idCurso,$usuario="",$filtro=""){
		//
		$sql = "SELECT count(*) "; 
		$sql.= "FROM usuarios as u ";
		$sql.= "LEFT OUTER JOIN inscripciones as i ON u.id = i.idEstudiante ";
		$sql.= "AND i.idCurso=".$idCurso." ";
		$sql.= "WHERE i.idEstudiante IS NULL AND u.tipo=".ESTUDIANTE;
		$salida = $this->db->query($sql);
		return $salida["count(*)"];
	}

	public function getCursosEstudiantes($idCurso,$inicio=1,$tamano=0){
		$salida = [];
		//
		$sql = "SELECT u.id, u.nombres, u.apellidoPaterno, u.apellidoMaterno, ";
		$sql.= "u.calificacion  "; 
		$sql.= "FROM usuarios as u ";
		$sql.= "LEFT OUTER JOIN inscripciones as i ON u.id = i.idEstudiante ";
		$sql.= "AND i.idCurso=".$idCurso." ";
		$sql.= "WHERE i.idEstudiante IS NULL AND u.tipo=".ESTUDIANTE." ";
		$sql.= "ORDER BY u.apellidoPaterno, u.apellidoMaterno ";
	    if ($tamano>0) {
			$sql.= "LIMIT ".$inicio.", ".$tamano;
		}
	    $salida = $this->db->querySelect($sql);
	    return $salida;
	}

	public function getIdCurso($id){
		$sql = "SELECT * FROM cursos WHERE baja=0 AND id=".$id;
	    $data = $this->db->query($sql);
	    return $data;
	}

	public function inscribirUsuario($id,$idCurso){
		$sql = "INSERT INTO inscripciones VALUES(0,".$id.",".$idCurso.",0)";
		return $this->db->queryNoSelect($sql);
	}

	/************************
	 * A S I S T E N C I A S
	 * **********************/
	public function getNumEstudiantesInscritos($idCurso,$usuario="",$filtro=""){
		$sql = "SELECT count(*) FROM inscripciones WHERE idCurso=".$idCurso;
		$salida = $this->db->query($sql);
		return $salida["count(*)"];
	}

	public function getEstudiantesInscritos($idCurso,$inicio=1,$tamano=0){
		//
		$sql = "SELECT u.id, u.nombres, u.apellidoPaterno, u.apellidoMaterno, ";
		$sql.= "i.calificacion  ";
		$sql.= "FROM usuarios as u, inscripciones as i ";
		$sql.= "WHERE i.idCurso=".$idCurso." AND u.id=i.idEstudiante";
		if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
	    return $this->db->querySelect($sql);
	}

	public function getNumClases($idCurso,$examen=false){
		$sql = "SELECT count(*) FROM clases WHERE idCurso=".$idCurso." ";
		if ($examen) {
			$sql.="AND tipoExamen>0";
		}
		$salida = $this->db->query($sql);
		return $salida["count(*)"];
	}

	public function getClases($idCurso,$inicio=1,$tamano=0){
	    $sql = "SELECT c.id, c.idCurso, c.fecha, c.observacion, c.tipoExamen, ";
		$sql.= "c.calificacion ";
		$sql.= "FROM clases as c ";
		$sql.= "WHERE c.idCurso=".$idCurso." ";
		$sql.= "ORDER BY c.fecha";
	    if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
	    return $this->db->querySelect($sql);
	}

	public function getAsistencias($idCurso,$idEstudiante){
		$sql = "SELECT * ";
		$sql.= "FROM asistencias ";
		$sql.= "WHERE idCurso=".$idCurso." ";
		$sql.= "AND idEstudiante=".$idEstudiante." ";
	    return $this->db->querySelect($sql);
	}

	public function actualizarAsistencia($idClase,$idEstudiante,$idCurso,$edo){
		$sql = "INSERT INTO asistencias VALUES(0,".$idClase.",".$idEstudiante.",".$idCurso.",".$edo.")";
		return $this->db->queryNoSelect($sql);
	}

	public function quitarAsistencia($idClase,$idCurso,$idEstudiante){
		$sql = "DELETE FROM asistencias WHERE idClase=".$idClase." AND idEstudiante=".$idEstudiante." AND idCurso=".$idCurso;
		return $this->db->queryNoSelect($sql);
	}

	/*****************************
	 * C A L I F I C A C I O N E S
	 * ***************************/
	public function getCalificaciones($idCurso,$idEstudiante){
		$sql = "SELECT c.* ";
		$sql.= "FROM calificaciones as c ";
		$sql.= "WHERE c.idCurso=".$idCurso." ";
		$sql.= "AND c.idEstudiante=".$idEstudiante;
	    return $this->db->querySelect($sql);
	}

	public function getIdClase($id){
		$sql = "SELECT * FROM clases WHERE id=".$id;
	    $data = $this->db->query($sql);
	    return $data;
	}

	public function getCaliCursoUsuario($idClase,$idEstudiante)
	{
		$sql = "SELECT * FROM calificaciones WHERE idClase=".$idClase;
		$sql.= " AND idEstudiante=".$idEstudiante;
		return $this->db->query($sql);
	}

	public function altaCalificacion($idCurso, $idClase, $idEstudiante, $cali, $observacion)
	{
		$sql = "INSERT INTO calificaciones VALUES(0,";
		$sql.= $idCurso.", ";
		$sql.= $idClase.", ";
		$sql.= $idEstudiante.", ";
		$sql.= $cali.", ";
		$sql.= "'".$observacion."')";
		return $this->db->queryNoSelect($sql);
	}
	public function modificarCalificacion($idCali,$cali,$observacion)
	{
		$sql = "UPDATE calificaciones SET ";
		$sql.= "calificacion=".$cali.", ";
		$sql.= "observacion='".$observacion."' ";
		$sql.= "WHERE id=".$idCali;
		return $this->db->queryNoSelect($sql);
	}
	public function calcularCalificacion($idCurso,$idEstudiante)
	{
		$sql = "SELECT AVG(calificacion) FROM calificaciones WHERE idCurso=".$idCurso." AND idEstudiante=".$idEstudiante;
		$salida = $this->db->query($sql);
		return round($salida["AVG(calificacion)"]);
	}
	public function actualizarCalificacionEstudiante($idCurso,$idEstudiante,$cali)
	{
		$sql = "UPDATE inscripciones SET ";
		$sql.= "calificacion=".$cali." ";
		$sql.= "WHERE idCurso=".$idCurso." AND idEstudiante=".$idEstudiante." ";
		return $this->db->queryNoSelect($sql);
	}
}
?>