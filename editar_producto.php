<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM camisetas WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$producto = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilos.css">
    <title>Editar producto</title>
</head>
<body>

<h2>Editar Producto</h2>

<form action="actualizar_producto.php" method="POST">
    <input type="hidden" name="id" value="<?= $producto['id']; ?>">

    Nombre:<br>
    <input type="text" name="nombre" value="<?= $producto['nombre']; ?>" required><br><br>

    Precio:<br>
    <input type="number" name="precio" value="<?= $producto['precio']; ?>" required><br><br>

    Imagen (ruta /img):<br>
    <input type="text" name="imagen" value="<?= $producto['imagen']; ?>"><br><br>

    Descripción:<br>
    <textarea name="descripcion"><?= $producto['descripcion']; ?></textarea><br><br>

    ¿En stock?<br>
    <select name="stock">
        <option value="1" <?= $producto['stock'] == 1 ? 'selected' : '' ?>>Sí</option>
        <option value="0" <?= $producto['stock'] == 0 ? 'selected' : '' ?>>No</option>
    </select><br><br>

    Talles disponibles:<br>
    <input type="text" name="talles" value="<?= $producto['talles']; ?>"><br><br>

    <button type="submit">Guardar cambios</button>
</form>

<a href="admin.php">Volver</a>

</body>
</html>