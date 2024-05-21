<?php  
/**
 * 
 */
class TableroModelo
{
	private $db = "";
	
	function __construct()
	{
		$this->db = new MySQLdb();
	}

	public function setUsuario($id, $nombres, $apellidoPaterno, $apellidoMaterno, $clave)
	{
		$sql = "UPDATE usuarios SET ";
		$sql.= "nombres='".$nombres."', ";
		$sql.= "apellidoMaterno='".$apellidoMaterno."', ";
		$sql.= "apellidoPaterno='".$apellidoPaterno."' ";
		if ($clave!="") {
			$clave = hash_hmac("sha512", $clave, CLAVE);
			$sql.= ", clave='".$clave."' ";
		}
		$sql.= "WHERE id=".$id;
		return $this->db->queryNoSelect($sql);
	}

	public function getUsuarioId($id='')
	{
		$sql = "SELECT * FROM usuarios WHERE id=".$id." AND baja=0";
		return $this->db->query($sql);
	}

	public function getCursos(){
		$sql = "SELECT * ";
		$sql.= "FROM cursos ";
		$sql.= "WHERE baja=0 ";
		$sql.= "ORDER BY fechaInicio ";
		$sql.= "LIMIT ".TAMANO_PAGINA;
		$data = $this->db->querySelect($sql);
		return $data;
	}

	public function getTablas()
	{
		return $this->db->querySelect("SHOW TABLES");
	}

	public function respaldarTabla($tabla='',$fecha="",$id="")
	{
		if (empty($tabla) || empty($fecha)) return false;
		$db = $this->db->getBaseDatos();
		$salida = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $db . "`\r\n--\r\n\r\n";
		$datos = $this->db->queryCrudo("SELECT * FROM ".$tabla);
		$campos = $datos->columnCount();
		$filas = $datos->rowCount();
		$esquemaTabla = $this->db->querySelect("SHOW CREATE TABLE ".$tabla);
		$esquema = $esquemaTabla[0]["Create Table"];
		$salida.= "\n\n".$esquema.";\n\n";
		for ($i=0, $contador=0; $i < $campos; $i++, $contador=0) { 
			while ($fila = $datos->fetch()) {
				// verificamos contador
				if ($contador%100==0||$contador==0) {
					$salida .= "\nINSERT INTO ".$tabla." VALUES";
				}
				$salida .= "\n(";
				for ($j=0; $j < $campos; $j++) { 
					$file[$j] = str_replace("\n", "\\n", addslashes($fila[$j]));
					if (isset($fila[$j])) {
						$salida .= '"'.$fila[$j].'"';
					} else {
						$salida .= '""';
					}
					if($j < ($campos-1)){
						$salida .= ',';
					}
				}
				$salida .= ")";
				//cada 100
				if ((($contador + 1)%100==0 && $contador !=0) || $contador+1==$filas) {
					$salida .= ";";
				} else {
					$salida .= ",";
				}
				$contador++;
			}
		}
		$salida .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
		$carpeta = "respaldos/".$fecha."-".$id;
		if (!file_exists($carpeta)) {
			mkdir($carpeta);
		}
		$archivo = sprintf('%s/%s.sql',$carpeta,$tabla);

		return file_put_contents($archivo, $salida) !== false;
	}
}
?>