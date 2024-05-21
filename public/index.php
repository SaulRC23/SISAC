<?php
// Registrar un mensaje en los logs para verificar que el archivo index.php está siendo accedido
error_log("El archivo index.php ha sido accedido");

// Incluir el archivo de inicio
require_once("../app/inicio.php");

// Verificar si el archivo de inicio fue incluido correctamente
if (file_exists("../app/inicio.php")) {
    error_log("El archivo inicio.php ha sido incluido correctamente");
} else {
    error_log("Error: No se pudo incluir el archivo inicio.php");
}

// Crear una instancia de la clase Control
try {
    $control = new Control();
    error_log("Instancia de Control creada correctamente");
} catch (Exception $e) {
    error_log("Error al crear la instancia de Control: " . $e->getMessage());
    die("Error al crear la instancia de Control: " . $e->getMessage());
}

// Continuar con el resto del código
?>
