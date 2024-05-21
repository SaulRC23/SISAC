<?php  
/**
 * 
 */
class MySQLdb
{
    private $host;
    private $usuario;
    private $clave;
    private $db;
    private $conn;
    
    function __construct()
    {
        // Obtener los valores de las variables de entorno o usar valores predeterminados
        $this->host = getenv('DB_HOST') ?: 'localhost:3307';
        $this->usuario = getenv('DB_USER') ?: 'root';
        $this->clave = getenv('DB_PASSWORD') ?: 'KolotGiltes$6491';
        $this->db = getenv('DB_NAME') ?: 'escuela';

        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->db, 
                $this->usuario, 
                $this->clave
            );
            // echo "Conectado";
        } catch (Exception $e) {
            die("No se pudo conectar: " . $e->getMessage());
        }
    }

    public function query($sql = '')
    {
        if (empty($sql)) return false;
        $stmt = $this->conn->query($sql);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function querySelect($sql = '')
    {
        if (empty($sql)) return false;
        $data = [];
        $stmt = $this->conn->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        do {
            array_push($data, $row);
        } while ($row = $stmt->fetch(PDO::FETCH_ASSOC));
        if (!$data[0]) {
            $data = [];
        }
        return $data;
    }

    // Update, Insert y Delete
    public function queryNoSelect($sql, $data = "")
    {
        if ($data == "") {
            return $this->conn->query($sql);
        } else {
            return $this->conn->prepare($sql)->execute($data);
        }
    }

    public function queryCrudo($sql = "")
    {
        return $this->conn->query($sql);
    }

    public function getBaseDatos()
    {
        return $this->db;
    }
}
?>
