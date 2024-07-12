<?php
session_start();
require 'config.php';

if (isset($_POST['id_carrito'])) {
    $id_carrito = $_POST['id_carrito'];

    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_carrito = ?");
    $stmt->bind_param("i", $id_carrito);

    if ($stmt->execute()) {
        header("Location: ver_carrito.php");
    } else {
        echo "Error al eliminar del carrito: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Datos inválidos.";
}

$conn->close();
?>
