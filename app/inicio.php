<?php
// Registrar un mensaje en los logs para verificar que el archivo inicio.php está siendo accedido
error_log("El archivo inicio.php ha sido accedido");

/* Clases y constantes del sistema*/
define("RUTA", "/escuela/");
define("LLAVE","Hombresneciosqueacusaisalamujersinrazonsinverquesoislaocasiondelomismoqueculpais");
define("CLAVE","mimamamemimamucho");
define("TAMANO_PAGINA",6);
define('PAGINAS_MAXIMAS',4);
define('ADMON',1);
define('PROFESOR',2);
define('ESTUDIANTE',3);
define('MODO_OSCURO','NO');
error_log("Constantes definidas");

// Incluir las clases necesarias y registrar mensajes de depuración
require_once("libs/Config.php");
error_log("Config.php incluido");
require_once("libs/MySQLdb.php");
error_log("MySQLdb.php incluido");
require_once("libs/Sesion.php");
error_log("Sesion.php incluido");
require_once("libs/Helper.php");
error_log("Helper.php incluido");
require_once("libs/Controlador.php");
error_log("Controlador.php incluido");
require_once("libs/Control.php");
error_log("Control.php incluido");

// Crear una instancia de Config y manejar errores
try {
    new Config("development");
    error_log("Config inicializada en modo desarrollo");
} catch (Exception $e) {
    error_log("Error al inicializar Config: " . $e->getMessage());
    die("Error al inicializar Config: " . $e->getMessage());
}
?>
