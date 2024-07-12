<?php
session_start();
require 'config.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

// Obtener los productos en el carrito del usuario
$stmt = $conn->prepare("SELECT c.id_carrito, p.id_producto, p.nombre, p.precio, p.disponibilidad, c.cantidad, p.imagenes 
                        FROM carrito c 
                        JOIN productos p ON c.id_producto = p.id_producto 
                        WHERE c.id_usuario = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$carrito = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Obtener los métodos de pago
$stmt = $conn->prepare("SELECT id_metodo, nombre FROM metodos_pago");
$stmt->execute();
$result = $stmt->get_result();
$metodos_pago = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$total = 0;
foreach ($carrito as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MayShop - Carrito</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item img {
            max-width: 70px;
            margin-right: 20px;
        }
        .cart-item-details {
            flex-grow: 1;
            display: flex;
            align-items: center;
        }
        .cart-item-quantity {
            display: flex;
            align-items: center;
        }
        .cart-item-quantity input {
            width: 60px;
            margin: 0 10px;
        }
        .cart-total {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
        }
        .cart-actions {
            text-align: right;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand text-white" href="index.php">MayShop</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link text-white" href="index.php">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="products.php">Mis Productos</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contacto</a></li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                            <li class="nav-item"><a class="nav-link text-white" href="favorites_page.php"><i class="fas fa-heart"></i></a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="profile.php"><i class="fas fa-user-gear"></i></a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="logout.php"><i class="fas fa-share-from-square"></i></a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link text-white" href="login.php">Iniciar sesión</a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="register.php">Registrarse</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        <h2>Carrito de Compras</h2>
        <?php if (isset($carrito) && count($carrito) > 0): ?>
            <?php foreach ($carrito as $item): ?>
                <div class="cart-item" data-id-carrito="<?php echo $item['id_carrito']; ?>">
                    <img src="<?php echo htmlspecialchars($item['imagenes']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
                    <div class="cart-item-details">
                        <div>
                            <h5><?php echo htmlspecialchars($item['nombre']); ?></h5>
                            <p>$<?php echo number_format($item['precio'], 2); ?></p>
                            <p>Disponibilidad: <?php echo htmlspecialchars($item['disponibilidad']); ?></p>
                        </div>
                        <div class="cart-item-quantity">
                            <input type="number" class="cantidad" value="<?php echo htmlspecialchars($item['cantidad']); ?>" min="1" max="<?php echo htmlspecialchars($item['disponibilidad']); ?>">
                        </div>
                        <div>
                            <form action="ver_carrito.php" method="post">
                                <input type="hidden" name="id_carrito" value="<?php echo $item['id_carrito']; ?>">
                                <button type="submit" name="delete_item" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <p class="total-item">Total: $<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="cart-total">
                <strong>Total del Carrito:</strong> $<span id="total-carrito"><?php echo number_format($total, 2); ?></span>
            </div>
            <div class="cart-actions">
                <form action="procesar_pedido.php" method="post">
                    <h5>Método de Pago</h5>
                    <?php foreach ($metodos_pago as $metodo): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="metodo_pago" id="metodo_<?php echo $metodo['id_metodo']; ?>" value="<?php echo $metodo['id_metodo']; ?>" required>
                            <label class="form-check-label" for="metodo_<?php echo $metodo['id_metodo']; ?>">
                                <?php echo htmlspecialchars($metodo['nombre']); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" name="checkout" class="btn btn-primary mt-3">Realizar Pedido</button>
                </form>
            </div>
        <?php else: ?>
            <p class="text-center mt-4">Tu carrito está vacío.</p>
        <?php endif; ?>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.cantidad').on('change', function() {
                var cantidad = $(this).val();
                var id_carrito = $(this).closest('.cart-item').data('id-carrito');
                var disponibilidad = $(this).attr('max');

                if (cantidad > disponibilidad) {
                    alert('La cantidad solicitada excede la disponibilidad del producto.');
                    $(this).val(disponibilidad);
                    return;
                }

                $.ajax({
                    url: 'actualizar_carrito.php',
                    method: 'POST',
                    data: {
                        id_carrito: id_carrito,
                        cantidad: cantidad
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.success) {
                            var totalItem = data.total_item.toFixed(2);
                            var totalCarrito = data.total_carrito.toFixed(2);

                            $('div[data-id-carrito="' + id_carrito + '"]').find('.total-item').text('Total: $' + totalItem);
                            $('#total-carrito').text('$' + totalCarrito);
                        } else {
                            alert('Error al actualizar la cantidad.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
