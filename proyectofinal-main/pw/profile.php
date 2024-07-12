<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

require 'config.php';

// Obtener el historial de pedidos del usuario
$id_usuario = $_SESSION['id_usuario'];
$sql = "SELECT p.id_pedido, p.fecha_pedido, p.estado, p.total, d.id_producto, prod.nombre as producto, d.cantidad, d.precio, prod.imagenes 
        FROM pedidos p 
        JOIN pedido_productos d ON p.id_pedido = d.id_pedido 
        JOIN productos prod ON d.id_producto = prod.id_producto 
        WHERE p.id_usuario = ?
        ORDER BY p.fecha_pedido DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$pedidos = [];
while ($row = $result->fetch_assoc()) {
    $pedidos[$row['id_pedido']]['fecha_pedido'] = $row['fecha_pedido'];
    $pedidos[$row['id_pedido']]['estado'] = $row['estado'];
    $pedidos[$row['id_pedido']]['total'] = $row['total'];
    $pedidos[$row['id_pedido']]['productos'][] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MayShop - Perfil de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="logo mb-0">MayShop</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="products.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contacto</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="profile.php"><i class="fas fa-user-gear" style="font-size: 20px;"></i></a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="logout.php"><i class="fas fa-share-from-square" style="font-size: 20px;"></i></a></li>

                </ul>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        <section class="profile">
            <h2>Perfil de Usuario</h2>
            <div class="card">
                <div class="card-body">
                    <p class="card-text"><strong>Nombre de usuario:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                    <p class="card-text"><strong>Correo electrónico:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                    <h3 class="card-title mt-4">Historial de Pedidos</h3>
                    <ul class="list-group">
                        <?php if (count($pedidos) > 0): ?>
                            <?php foreach ($pedidos as $id_pedido => $pedido): ?>
                                <li class="list-group-item">
                                    <strong>Fecha del pedido:</strong> <?php echo htmlspecialchars($pedido['fecha_pedido']); ?><br>
                                    <strong>Estado:</strong> <?php echo htmlspecialchars($pedido['estado']); ?><br>
                                    <strong>Total:</strong> $<?php echo number_format($pedido['total'], 2); ?>
                                    <ul class="list-group mt-2">
                                        <?php foreach ($pedido['productos'] as $producto): ?>
                                            <li class="list-group-item">
                                                <img src="<?php echo htmlspecialchars($producto['imagenes']); ?>" alt="Imagen del producto" class="img-thumbnail" style="width: 50px; height: 50px; float: left; margin-right: 15px;">
                                                <strong>Producto:</strong> <?php echo htmlspecialchars($producto['producto']); ?><br>
                                                <strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?><br>
                                                <strong>Cantidad:</strong> <?php echo htmlspecialchars($producto['cantidad']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">No has realizado ningún pedido.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>



