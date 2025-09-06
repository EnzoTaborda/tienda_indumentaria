<?php
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel Admin</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Panel de Administración</h2><br><br>
    <a href="index.php">Volver al inicio</a><br><br>

    <form action="agregar_producto.php" method="POST">
        <div class ="admin-conteiner">
        <p>Agregar Remera<br></p>
        Nombre: <input type="text" name="nombre" required><br><br>
        Precio: <input type="number" name="precio" required><br><br>
        Imagen (ruta dentro de /img): <input type="text" name="imagen" required><br><br>
        Descripción: <textarea name="descripcion"></textarea><br><br>
        Talles disponibles (ej: S,M,L,XL): <input type="text" name="talles" value="S,M,L,XL"><br><br>
        ¿En stock?
        <select name="stock">
            <option value="1" selected>Sí</option>
            <option value="0">No</option>
        </select><br><br>
        <button type="submit">Agregar Remera</button>
        </div>
    </form>
    <form action="editar_stock.php" method="POST"> 
         <div class ="admin-conteiner">
        <p>Editar stock<br></p>
        <label for="producto">Selecciona la remera:</label>
        <select name="nombre_s" id="producto">
            <?php
            $result = $conn->query("SELECT nombre FROM camisetas");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['nombre']}'>{$row['nombre']}</option>";
            }
            ?>
            </select><br><br>
            <label for="stock">¿Mostrar en catálogo?</label>
            <select name="stock" id="stock">
            <option value="1">Sí</option>
            <option value="0">No</option>
            </select><br><br>
            <button type="submit">Editar stock</button>
        </div>
    </form>
    <br>
     <div class="catalogo">
        <?php include 'productos.php'; ?>
    </div>
</body>
</html>
