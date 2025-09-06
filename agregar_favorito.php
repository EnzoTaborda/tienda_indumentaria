<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    echo "Debes iniciar sesión para guardar favoritos.";
    exit;
}

$usuario = $_SESSION['usuario'];
$camiseta_id = intval($_POST['camiseta_id']); // por seguridad

// Buscar ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows != 1) exit("Usuario inválido");

$usuario_id = $res->fetch_assoc()['id'];

// Insertar favorito
$stmt = $conn->prepare("INSERT IGNORE INTO favoritos (usuario_id, camiseta_id) VALUES (?, ?)");
$stmt->bind_param("ii", $usuario_id, $camiseta_id);
$stmt->execute();

header("Location: favoritos.php");
exit;
