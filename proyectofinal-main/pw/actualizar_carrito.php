<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_carrito = $_POST['id_carrito'];
    $cantidad = $_POST['cantidad'];

    $stmt = $conn->prepare("UPDATE carrito SET cantidad = ? WHERE id_carrito = ?");
    $stmt->bind_param("ii", $cantidad, $id_carrito);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("SELECT c.id_carrito, p.precio, c.cantidad, (p.precio * c.cantidad) AS total_item, 
                            (SELECT SUM(p.precio * c.cantidad) 
                             FROM carrito c 
                             JOIN productos p ON c.id_producto = p.id_producto 
                             WHERE c.id_usuario = ?) AS total_carrito
                            FROM carrito c 
                            JOIN productos p ON c.id_producto = p.id_producto 
                            WHERE c.id_carrito = ?");
    $stmt->bind_param("ii", $_SESSION['id_usuario'], $id_carrito);
    $stmt->execute();
    $stmt->bind_result($id_carrito, $precio, $cantidad, $total_item, $total_carrito);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['success' => true, 'total_item' => $total_item, 'total_carrito' => $total_carrito]);
}

$conn->close();
?>
