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
// Verificar si ya esta en favoritos
$check = $conn->prepare("SELECT 1 FROM favoritos WHERE usuario_id = ? AND camiseta_id = ?");
$check->bind_param("ii", $usuario_id, $camiseta_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "Ya agregaste esta remera a favoritos. <a href='index.php'>Volver</a>";
    exit;
}else{


// Insertar favorito
$stmt = $conn->prepare("INSERT IGNORE INTO favoritos (usuario_id, camiseta_id) VALUES (?, ?)");
$stmt->bind_param("ii", $usuario_id, $camiseta_id);
$stmt->execute();

header("Location: favoritos.php");
};
exit;
