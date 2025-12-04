<?php
session_start();
include 'conexion.php';

if (!isset($_GET['id'])) {
    echo "Producto no encontrado.";
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM camisetas WHERE id = $id AND stock = 1";
$resultado = $conn->query($sql);

if ($resultado->num_rows == 0) {
    echo "Producto no encontrado o no disponible.";
    exit();
}

$producto = $resultado->fetch_assoc();
$talles = explode(',', $producto['talles']); // Convertir la cadena a array
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($producto['nombre']); ?></title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <img src="img/logo_tienda.png" alt="Logo de la tienda" class="logo">
        <h1>La Cueva</h1>
        <h5>Indumentaria Deportiva</h5>

        <a href="index.php" class="boton">inicio</a>
    </header>

    <div class="detalle_producto">
        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
        <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
        <p class="precio">$<?php echo htmlspecialchars($producto['precio']); ?></p>
        <p><?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>

        <div class="talles">
            <?php echo "Talles: "?>
            <?php foreach ($talles as $talle): ?>
                <span><?php echo htmlspecialchars(trim($talle)); ?></span>
            <?php endforeach; ?>
        </div>

            <!--Botón de favoritos -->
    <?php if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] === 'cliente'): ?>
        <form method="POST" action="agregar_favorito.php">
            <input type="hidden" name="camiseta_id" value="<?php echo $producto['id']; ?>">
            <button type="submit">Agregar a Favoritos ❤️</button>
        </form>
    <?php endif; ?>

        <form action="agregar_carrito.php" method="POST">
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">
            <input type="hidden" name="nombre" value="<?= $producto['nombre'] ?>">
            <input type="hidden" name="precio" value="<?= $producto['precio'] ?>">
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>

    <br>
    <a href="index.php" class="boton">Volver al inicio</a>
</body>
</html>