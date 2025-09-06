<?php
include 'conexion.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD']=='POST'){
    $usuario = trim($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    if(empty($usuario) || empty($contrasena)){
        echo "Todos los campos son necesarios.";
    }else{
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (usuario, contrasena, rol) VALUES (?, ?, 'cliente')";
        $stmt = $conn->prepare($sql);

        if(!$stmt){
            die("Error en la preparación: " . $conn->error);
        }

        $stmt->bind_param("ss", $usuario, $hash);

        if($stmt->execute()){
            // Redirigir sin echo antes del header
            header("Location: login.php?msg=ok");
            exit;
        }else{
            echo "Error al crear el usuario: " . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <img src="img/logo_tienda.png" alt="Logo de la tienda" class="logo">
        <h1>La Cueva</h1>
        <h5>Indumentaria Deportiva</h5>

    </header>
    <div class="sesion-wrapper">
        <div class="sesion-container">
            <h2>Crear usuario</h2>
            <form action="" method="POST">
                Usuario: <input type="text" name="usuario" required><br><br>
                Contraseña: <input type="password" name="contrasena" required><br><br>
                <button type="submit">Crear usuario</button>
            </form>
        </div>
    </div>
</body>
</html>
