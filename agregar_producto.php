<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = "img/" . basename($_POST['imagen']);
$descripcion = $_POST['descripcion'];
$talles = $_POST['talles'];
$stock = isset($_POST['stock']) ? $_POST['stock'] : 0;

// Usar consulta preparada para evitar SQL Injection
$sql = "INSERT INTO camisetas (nombre, precio, imagen, descripcion, talles, stock) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdsssi", $nombre, $precio, $imagen, $descripcion, $talles, $stock);

if ($stmt->execute()) {
    header("Location: admin.php");
    exit();
} else {
    echo "Error al agregar la camiseta: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>