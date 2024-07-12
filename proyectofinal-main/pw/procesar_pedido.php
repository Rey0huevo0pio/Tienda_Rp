<?php
session_start();
require 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
    $metodo_pago = $_POST['metodo_pago'];
    $fecha_pedido = date("Y-m-d H:i:s");
    $estado = "Pendiente";

    $stmt = $conn->prepare("SELECT c.id_carrito, p.id_producto, p.precio, c.cantidad 
                            FROM carrito c 
                            JOIN productos p ON c.id_producto = p.id_producto 
                            WHERE c.id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $carrito = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    $stmt = $conn->prepare("INSERT INTO pedidos (id_usuario, fecha_pedido, estado, total, metodo_pago) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issds", $id_usuario, $fecha_pedido, $estado, $total, $metodo_pago);
    $stmt->execute();
    $id_pedido = $stmt->insert_id;
    $stmt->close();

    foreach ($carrito as $item) {
        $stmt = $conn->prepare("INSERT INTO pedido_productos (id_pedido, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $id_pedido, $item['id_producto'], $item['cantidad'], $item['precio']);
        $stmt->execute();
        $stmt->close();
    }

    $stmt = $conn->prepare("DELETE FROM carrito WHERE id_usuario = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Pedido realizado con éxito.'); window.location.href='index.php';</script>";
}

$conn->close();
?>
