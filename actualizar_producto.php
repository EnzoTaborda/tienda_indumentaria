<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$imagen = $_POST['imagen'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$talles = $_POST['talles'];

$stmt = $conn->prepare("UPDATE camisetas SET nombre=?, precio=?, imagen=?, descripcion=?, stock=?, talles=? WHERE id=?");

$stmt->bind_param("sdssisi", $nombre, $precio, $imagen, $descripcion, $stock, $talles, $id);
if ($stmt->execute()) {
    echo "Producto actualizado correctamente. <a href='admin.php'>Volver</a>";
} else {
    echo "Error al actualizar: " . $conn->error;
}
?>