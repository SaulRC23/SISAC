<?php
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
require_once("libs/Config.php");
require_once("libs/MySQLdb.php");
require_once("libs/Sesion.php");
require_once("libs/Helper.php");
require_once("libs/Controlador.php");
require_once("libs/Control.php");
new Config("development");
?>