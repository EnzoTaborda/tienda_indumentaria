<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];

// Obtener ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$res = $stmt->get_result();
$usuario_id = $res->fetch_assoc()['id'];

$camiseta_id = $_POST['camiseta_id'];

// Eliminar favorito
$stmt = $conn->prepare("DELETE FROM favoritos WHERE usuario_id = ? AND camiseta_id = ?");
$stmt->bind_param("ii", $usuario_id, $camiseta_id);

if ($stmt->execute()) {
    header("Location: favoritos.php");
} else {
    echo "Error al eliminar: " . $conn->error;
}