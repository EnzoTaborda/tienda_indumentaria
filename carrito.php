<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
<header>
    <img src="img/logo_tienda.png" alt="Logo de la tienda" class="logo">
    <h1>La Cueva</h1>
    <h5>Indumentaria Deportiva</h5>

    <?php if (isset($_SESSION['usuario'])): ?>    
        <p>Bienvenido, <?php echo $_SESSION['usuario']; ?> |
            <a href="logout.php" class="boton">Cerrar sesión</a>
        </p>

        <?php if ($_SESSION['rol'] === 'cliente'): ?>
            <a href="favoritos.php" class="boton">Favoritos</a>
        <?php endif; ?>

    <?php else: ?>
        <a href="login.php" class="boton">Iniciar sesión</a>
        <a href="crear_usuario.php" class="boton">Crear usuario</a>
    <?php endif; ?>
</header>

<main>
    <h2>Carrito de compras</h2>

    <?php
    // Si no hay carrito
    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        echo "<p>Tu carrito está vacío.</p>";
        exit;
    }

    $total = 0;

    // MOSTRAR PRODUCTOS
    foreach ($_SESSION['carrito'] as $id => $prod) {
        $subtotal = $prod['precio'] * $prod['cantidad'];
        $total += $subtotal;
        ?>

        <div class="producto-carrito">
            <h3><?= $prod['nombre'] ?></h3>
            <p>Precio: $<?= $prod['precio'] ?></p>
            <p>Cantidad: <?= $prod['cantidad'] ?></p>
            <p>Subtotal: $<?= $subtotal ?></p>
        </div>
        <hr>

    <?php 
    } // FIN DEL FOREACH
    ?>

    <h3>Total: $<?= $total ?></h3>

    <?php
    // ARMADO DE MENSAJE PARA WHATSAPP
    $mensaje = "Hola! Quiero realizar una compra:%0A";

    foreach ($_SESSION['carrito'] as $prod) {
        $mensaje .= "- {$prod['nombre']} x {$prod['cantidad']} = \$" . ($prod['precio'] * $prod['cantidad']) . "%0A";
    }

    $mensaje .= "%0ATotal: \$$total";

    $telefono = "+5493743618524";
    ?>

    <a 
        href="https://wa.me/<?= $telefono ?>?text=<?= $mensaje ?>" 
        class="boton-comprar"
        style="display:inline-block; padding:10px 20px; background:green; color:white; text-decoration:none; border-radius:5px;">
        Finalizar compra por WhatsApp
    </a>

</main>

</body>
</html>