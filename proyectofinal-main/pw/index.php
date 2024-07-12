<?php
session_start();
require 'config.php';

// Obtener todas las categorías de la base de datos
$stmt = $conn->prepare("SELECT id_categoria, nombre FROM categorias");
$stmt->execute();
$result = $stmt->get_result();
$categorias = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Verificar si se ha seleccionado una categoría
$categoria_seleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : null;

if ($categoria_seleccionada) {
    // Obtener los productos de la categoría seleccionada
    $stmt = $conn->prepare("SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.imagenes, p.disponibilidad, u.nombre as usuario 
                            FROM productos p 
                            JOIN Usuarios u ON p.id_usuario = u.id_usuario
                            WHERE p.categoria_id = ?");
    $stmt->bind_param("i", $categoria_seleccionada);
} else {
    // Obtener todos los productos de la base de datos
    $stmt = $conn->prepare("SELECT p.id_producto, p.nombre, p.descripcion, p.precio, p.imagenes, p.disponibilidad, u.nombre as usuario 
                            FROM productos p 
                            JOIN Usuarios u ON p.id_usuario = u.id_usuario");
}
$stmt->execute();
$result = $stmt->get_result();
$productos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MayShop - Página de Inicio</title>
    <link rel="icon" href="./banners/logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
        .heart-button {
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .heart-button img {
            width: 24px;
            height: 24px;
        }

        .heart-button:hover img {
            transform: scale(1.2);
        }

        .welcome-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }

        .product-card {
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .header-image {
            width: 100%;
            height: auto;
        }

        .carousel-item img {
            height: 300px; /* Adjust the height as needed */
            object-fit: cover;
            object-position: center;
        }

        .category-list {
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .category-list h4 {
            margin-bottom: 15px;
        }

        .category-list ul {
            list-style-type: none;
            padding: 0;
        }

        .category-list ul li {
            padding: 5px 0;
        }

        .category-list ul li a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .category-list ul li a:hover {
            color: #0056b3;
        }

        .like-button {
            background: none;
            border: none;
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
        }

        .like-button img {
            width: 24px;
            height: 24px;
        }

        .like-button p {
            display: inline-block;
            margin-left: 10px;
        }

        .like-button.clicked img {
            animation: like-animation 0.5s ease-in-out;
        }

        @keyframes like-animation {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
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
                        <li class="nav-item"><a class="nav-link text-white" href="products.php">Mi Productos</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contacto</a></li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                            <li class="nav-item"><a class="nav-link text-white" href="favorites_page.php"><i class="fas fa-heart" style="font-size: 20px;"></i></a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="profile.php"><i class="fas fa-user-gear" style="font-size: 20px;"></i></a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="ver_carrito.php"><i class="fa-solid fa-cart-shopping" style="font-size: 20px;"></i></a></li>
                            <li class="nav-item"><a class="nav-link text-white" href="logout.php"><i class="fas fa-share-from-square" style="font-size: 20px;"></i></a></li>
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
        <div class="row">
            <aside class="col-md-3">
                <div class="category-list">
                    <h4>Categorías</h4>
                    <ul>
                        <?php foreach ($categorias as $categoria): ?>
                            <li><a href="?categoria=<?php echo $categoria['id_categoria']; ?>"><?php echo htmlspecialchars($categoria['nombre']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </aside>
            <section class="col-md-9">
                <div class="welcome-section text-center">
                    <h2>Bienvenido a MayShop</h2>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <?php else: ?>
                        <p><a href="register.php" class="btn btn-primary">Comienza ahora</a></p>
                    <?php endif; ?>
                </div>

                <section id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./banners/de.webp" class="d-block w-100" alt="Laptop">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Modern Laptop</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./banners/de.webp" class="d-block w-100" alt="Producto 2">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Producto 2</h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="./banners/de.webp" class="d-block w-100" alt="Producto 3">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>Producto 3</h5>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </section>

                <section class="product-list mt-5">
                    <h2>Productos</h2>
                    <div class="row">
                        <?php foreach ($productos as $producto): ?>
                            <div class="col-md-4 mb-4">
                                <div class="card product-card h-100">
                                    <img src="<?php echo htmlspecialchars($producto['imagenes']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="card-img-top">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                        <p class="card-text">$<?php echo number_format($producto['precio'], 2); ?></p>
                                        <p class="card-text"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                        <p class="card-text"><strong>Vendedor:</strong> <?php echo htmlspecialchars($producto['usuario']); ?></p>
                                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                                            <form action="add_favorite.php" method="post">
                                                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
                                                <button type="submit" class="heart-button like-button">
                                                    <i class="fas fa-heart" style="font-size: 30px;"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                        <button type="button" class="btn btn-info mt-2" data-toggle="modal" data-target="#productModal<?php echo $producto['id_producto']; ?>">Detalles</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="productModal<?php echo $producto['id_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel<?php echo $producto['id_producto']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productModalLabel<?php echo $producto['id_producto']; ?>"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?php echo htmlspecialchars($producto['imagenes']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                            <p class="mt-3">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                                            <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                            <p><strong>Descripción del vendedor:</strong> <?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                            <form action="carrito.php" method="post">
                                                <input type="hidden" name="id_producto" value="<?php echo htmlspecialchars($producto['id_producto']); ?>">
                                                <div class="form-group">
                                                    <label for="cantidad">Cantidad:</label>
                                                    <input type="number" name="cantidad" class="form-control" value="1" min="1" max="<?php echo htmlspecialchars($producto['disponibilidad']); ?>" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary">
                                                <i class="fa-solid fa-cart-shopping"></i> Agregar al carrito
                                                </button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </section>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        document.querySelectorAll('.like-button').forEach(function(button) {
            button.addEventListener('click', function(event) {
                button.classList.add('clicked');
                setTimeout(function() {
                    button.classList.remove('clicked');
                }, 1000);
            });
        });
    </script>
</body>
</html>
