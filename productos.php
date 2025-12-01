<?php
include 'conexion.php';

$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if ($buscar != '') {
    // Consulta con filtro de búsqueda
    $sql = "SELECT * FROM camisetas WHERE stock != 0 AND nombre LIKE ?";
    $stmt = $conn->prepare($sql);
    $param = "%$buscar%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $resultado = $stmt->get_result();
} else {
    // Consulta normal (sin búsqueda)
    $sql = "SELECT * FROM camisetas WHERE stock != 0";
    $resultado = $conn->query($sql);
}

if ($resultado->num_rows > 0) {
    while ($producto = $resultado->fetch_assoc()) {
        echo "<div class='producto'>";
        echo "<a href='detalle_producto.php?id={$producto['id']}' target='_blank'>";
        echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}' width='200'>";
        echo "</a>";
        echo "<h3>{$producto['nombre']}</h3>";
        echo "<p>Precio: \${$producto['precio']}</p>";
        echo "</div>";
    }
} else {
    echo "<p style='text-align:center; color:red;'>No se encontraron productos.</p>";
}

$conn->close();