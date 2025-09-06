<?php
$host = "sql105.infinityfree.com";   // Host dado por InfinityFree
$usuario = "if0_39875410";          // usuario MySQL dado por InfinityFree
$clave = "UYTznzCAuF";               // contraseña en InfinityFree
$bd = "if0_39875410_tienda";        // Nombre de la base de datos en InfinityFree

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>