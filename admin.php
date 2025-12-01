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
<h3>Editar productos</h3>

<table border="1" cellpadding="5">
<tr>
    <th>Nombre</th>
    <th>Editar</th>
</tr>

<?php
$result = $conn->query("SELECT id, nombre FROM camisetas");
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['nombre']}</td>";
    echo "<td><a class='boton' href='editar_producto.php?id={$row['id']}'>Editar</a></td>";
    echo "</tr>";
}
?>
</table>

</body>
</html>
