<?php
session_start();
require 'config.php';

if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $id_usuario = $_SESSION['id_usuario'];
        $id_producto = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        // Verificar si el producto ya está en el carrito
        $stmt = $conn->prepare("SELECT id_carrito, cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $stmt->bind_param("ii", $id_usuario, $id_producto);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Producto ya en el carrito, actualizar la cantidad
            $row = $result->fetch_assoc();
            $nueva_cantidad = $row['cantidad'] + $cantidad;
            $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_carrito = ?");
            $stmt->bind_param("ii", $nueva_cantidad, $row['id_carrito']);
        } else {
            // Producto no está en el carrito, insertarlo
            $stmt = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $id_usuario, $id_producto, $cantidad);
        }

        if ($stmt->execute()) {
            header("Location: ver_carrito.php");
        } else {
            echo "Error al agregar al carrito: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Debe iniciar sesión para agregar productos al carrito.";
    }
} else {
    echo "Datos inválidos.";
}

$conn->close();
?>
