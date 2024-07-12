<?php
session_start();
require 'config.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_POST['id_producto'])) {
    $userId = $_SESSION['id_usuario'];
    $productId = $_POST['id_producto'];

    // Verificar si el producto ya está en favoritos
    $sql = "SELECT * FROM favoritos WHERE id_usuario = ? AND id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Si no está en favoritos, agregarlo
        $sql = "INSERT INTO favoritos (id_usuario, id_producto) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userId, $productId);

        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // Si ya está en favoritos, redirigir con un mensaje
        header("Location: index.php?message=already_favorite");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
}
?>
