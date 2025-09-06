<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    // Buscar usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $user = $resultado->fetch_assoc();

        // Verificar contraseña
        if (password_verify($contrasena, $user['contrasena'])) {
            // ¿Es admin?
            if ($user['rol'] === 'admin') {
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['rol'] = 'admin';
                header("Location: index.php");
            exit();
        } else {
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['rol'] = 'cliente';
                echo "Bienvenido ".$user['usuario'];
                header("Location: index.php");
            exit();
        }
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="estilos.css">

</head>
    <header>
        <img src="img/logo_tienda.png" alt="Logo de la tienda" class="logo">
        <h1>La Cueva</h1>
        <h5>Indumentaria Deportiva</h5>

    </header>
<body>
    <div class ="sesion-wrapper">
        <div class="sesion-container">
            <h2>Iniciar sesión</h2>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form action="login.php" method="POST">
            Usuario: <input type="text" name="usuario" required><br>
            Contraseña: <input type="password" name="contrasena" required><br>
            <button type="submit">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</body>