<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // Configuración local
    $host = "localhost";
    $usuario = "root";
    $clave = "";
    $bd = "tienda";
} else {
    // Configuración online 
    $host = "sql105.infinityfree.com";   // Host dado por InfinityFree
    $usuario = "if0_39875410";          // usuario MySQL dado por InfinityFree
    $clave = "UYTznzCAuF";               // contraseña en InfinityFree
    $bd = "if0_39875410_tienda";        // Nombre de la base de datos en InfinityFree
}

$conn = new mysqli($host, $usuario, $clave, $bd);
?>