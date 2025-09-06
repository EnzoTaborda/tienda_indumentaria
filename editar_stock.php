<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'conexion.php';
$nombre = $_POST['nombre_s'];
$stock = $_POST['stock'];

//consulta segura
$stmt = $conn->prepare("UPDATE camisetas SET stock = ? WHERE nombre = ?");
$stmt->bind_param("is", $stock, $nombre);

if ($stmt->execute()) {
    echo "Stock actualizado correctamente. <a href='admin.php'>Volver</a>";
} else {
    echo "Error al actualizar el stock: " . $conn->error;
}

$stmt->close();
$conn->close();
?>