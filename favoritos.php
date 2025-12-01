<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <img src="img/logo_tienda.png" alt="Logo de la tienda" class="logo">
        <h1>La Cueva</h1>
        <h5>Indumentaria Deportiva</h5>
        <php>
        <a href="index.php" class="boton">inicio</a>
        <a href="logout.php" class="boton">cerrar sesion</a>
        </php>
    </header>
</body>
</html>

<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    echo "Debes iniciar sesión para ver tus favoritos.";
    exit;
}

$usuario = $_SESSION['usuario'];

// Obtener ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$res = $stmt->get_result();
$usuario_id = $res->fetch_assoc()['id'];

// Consultar productos favoritos
$sql = "SELECT camisetas.* FROM camisetas 
        JOIN favoritos ON camisetas.id = favoritos.camiseta_id 
        WHERE favoritos.usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();

echo "<h2>Mis camisetas Favoritas</h2>";
echo "<div class='catalogo'>";
while ($producto = $resultado->fetch_assoc()) {
    echo "<div class='producto'>";
        echo "<a href='detalle_producto.php?id={$producto['id']}' target='_blank'>";
        echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}' width='200'>";
        echo "</a>";
        echo "<h3>{$producto['nombre']}</h3>";
        echo "<p>Precio: \${$producto['precio']}</p>";
         // Botón para quitar de favoritos
        echo "<form action='quitar_favorito.php' method='POST'>";
        echo "<input type='hidden' name='camiseta_id' value='{$producto['id']}'>";
        echo "<button type='submit' class='boton-quitar'>Quitar de favoritos</button>";
        echo "</form>";
    echo "</div>";
}
echo "</div>"; 
?>

