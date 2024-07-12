<?php
session_start();
require 'config.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Obtener los productos del usuario actual de la base de datos
$stmt = $conn->prepare("SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.disponibilidad, c.nombre as categoria, p.imagenes 
                        FROM productos p 
                        JOIN categorias c ON p.categoria_id = c.id_categoria
                        WHERE p.id_usuario = ?");
$stmt->bind_param("i", $_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MayShop - Mis Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .product img {
            max-width: 100%;
            height: auto;
        }
        .product {
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: scale(1.05);
        }
    </style>
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
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <li class="nav-item"><a class="nav-link text-white" href="profile.php">Perfil</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="logout.php">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-white" href="login.php">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="register.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        <section class="productos">
            <h2 class="text-center">Mis Productos</h2>
            <div class="text-right mb-4">
                <a href="add_product.php" class="btn btn-success">Agregar Producto Nuevo</a>
            </div>
            <div class="row">
                <?php foreach ($productos as $producto): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 product">
                            <img src="<?php echo htmlspecialchars($producto['imagenes']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                <p class="card-text"><strong>$<?php echo number_format($producto['precio'], 2); ?></strong></p>
                                <p class="card-text"><strong>Disponibilidad:</strong> <?php echo htmlspecialchars($producto['disponibilidad']); ?></p>
                                <p class="card-text"><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['categoria']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
                    

