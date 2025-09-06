<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Remeras</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <img src="img/logo_tienda.png" alt="Logo de la tienda" class = "logo">
        <h1>La Cueva</h1>
        <h5>Indumentaria Deportiva</h5>
        <?php if (isset($_SESSION['usuario'])): ?>    
            <p>Bienvenido, <?php echo $_SESSION['usuario']; ?> |
            <a href="logout.php" class="boton">Cerrar sesión</a></p>
        <?php if ($_SESSION['rol'] === 'admin'): ?>
            <a href="admin.php" class="boton">Panel de Admin</a>
        <?php endif; ?>

        <?php if ($_SESSION['rol'] === 'cliente'): ?>
            <a href="favoritos.php" class="boton">Favoritos</a>
        <?php endif; ?> 
        <?php else: ?>
            <a href="login.php" class="boton">Iniciar sesión</a>
            <a href= "crear_usuario.php" class="boton">crear usuario</a>
        <?php endif; ?>
        <form method="GET" action="index.php" style="text-align:center; margin: 20px;">
    <input type="text" name="buscar" placeholder="Buscar remera..." 
           value="<?php echo isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : ''; ?>" 
           style="padding: 8px; width: 250px; border-radius: 5px; border: 1px solid #ccc;">
    <button type="submit" style="padding: 8px 15px; background:#ff6600; color:white; border:none; border-radius:5px; cursor:pointer;">Buscar</button>
</form>
    </header>

    <main>
        <div class="catalogo">
            <?php include 'productos.php'; ?>
        </div>
    </main>
</body>
</html>
