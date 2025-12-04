<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];

// Si el producto ya existe en el carrito, sumar cantidad
if (isset($_SESSION['carrito'][$id])) {
    $_SESSION['carrito'][$id]['cantidad']++;
} else {
    $_SESSION['carrito'][$id] = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => 1
    ];
}

header("Location: carrito.php");
exit;