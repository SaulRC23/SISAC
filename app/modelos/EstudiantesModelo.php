<?php  
/**
 * 
 */
class EstudiantesModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function getCursosEstudiante($idEstudiante){
		$sql = "SELECT i.*, c.nombre, c.fechaInicio, c.fechaFin ";
		$sql.= "FROM inscripciones AS i, cursos AS c ";
		$sql.= "WHERE i.idEstudiante=".$idEstudiante." AND ";
		$sql.= "i.idCurso=c.id";
		$data = $this->db->querySelect($sql);
		return $data;
	}

	public function calificaciones($idCurso,$idEstudiante){
		$sql = "SELECT c.*, k.idEstudiante, k.calificacion as cali, k.id as idCali ";
		$sql.= "FROM clases as c ";
		$sql.= "LEFT JOIN calificaciones as k ";
		$sql.= "ON c.id=k.idClase AND k.idEstudiante=".$idEstudiante." ";
		$sql.= "WHERE c.idCurso=".$idCurso." ";
		$sql.= "ORDER BY c.fecha";
		return $this->db->querySelect($sql);
	}

	public function getIdCurso($id){
		$sql = "SELECT * FROM cursos WHERE id=".$id;
	    $data = $this->db->query($sql);
	    return $data;
	}

	public function getCatalogos($tipo='')
	{
		$sql = "SELECT * FROM catalogos WHERE tipo='".$tipo."' ORDER BY clave";
		return $this->db->querySelect($sql);
	}

	/******************/

	public function getNumClases($idCurso)
	{
		$sql = "SELECT count(*) FROM clases WHERE idCurso=".$idCurso." ";
		$salida = $this->db->query($sql);
		return $salida["count(*)"];
	}

	public function getClases($idCurso,$idEstudiante,$inicio=1,$tamano=0){
		$sql = "SELECT c.*, a.idEstudiante, a.estado, a.id as idAsistencia  ";
		$sql.= "FROM clases as c ";
		$sql.= "LEFT JOIN asistencias as a ";
		$sql.= "ON c.id=a.idClase ";
		$sql.= "AND a.idEstudiante=".$idEstudiante." ";
		$sql.= "WHERE c.idCurso=".$idCurso." ";
		$sql.= "ORDER BY c.fecha";
	    if ($tamano>0) {
			$sql.= " LIMIT ".$inicio.", ".$tamano;
		}
	    return $this->db->querySelect($sql);
	}
}
?>