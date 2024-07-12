<?php
require 'config.php';
// favorites.php

function getFavoriteProducts($userId) {
    global $conn;
    $stmt = $conn->prepare("SELECT p.id_producto, p.nombre, p.precio, p.imagenes FROM favoritos f JOIN productos p ON f.id_producto = p.id_producto WHERE f.id_usuario = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    return $products;
}

function removeFavoriteProduct($userId, $productId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM favoritos WHERE id_usuario = ? AND id_producto = ?");
    $stmt->bind_param("ii", $userId, $productId);
    $stmt->execute();
    $stmt->close();
}
?>



