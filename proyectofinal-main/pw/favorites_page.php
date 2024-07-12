<?php
session_start();
require 'config.php';
include 'favorites.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_favorite'])) {
    $productId = $_POST['product_id'];
    $userId = $_SESSION['id_usuario'];
    removeFavoriteProduct($userId, $productId);
    header("Location: favorites_page.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>MayShop - Mis Favoritos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .favorite-products {
            padding: 20px 0;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease;
            width: 100%;
            max-width: 250px;
        }
        .product img {
            max-width: 100%;
            border-radius: 10px;
        }
        .product h3 {
            font-size: 1.2em;
            margin: 15px 0 10px;
        }
        .product p {
            margin: 0;
            color: #333;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product-grid .empty {
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="logo">
                <h1>MayShop</h1>
            </div>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="products.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="contact.php">Contacto</a></li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <li class="nav-item"><a class="nav-link text-white" href="profile.php"><i class="fas fa-user-gear" style="font-size: 20px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="favorites_page.php"><i class="fas fa-heart" style="font-size: 20px;"></i></a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="logout.php"><i class="fas fa-share-from-square" style="font-size: 20px;"></i></a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-white" href="login.php">Iniciar sesión</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="register.php">Registrarse</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mt-4">
        <section class="favorite-products">
            <h2 class="text-center">Mis Productos Favoritos</h2>
            <div class="product-grid">
                <?php
                $userId = $_SESSION['id_usuario'];
                $products = getFavoriteProducts($userId);
                if (!empty($products)):
                    foreach ($products as $product):
                ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars($product['imagenes']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>">
                    <h3><?php echo htmlspecialchars($product['nombre']); ?></h3>
                    <p>$<?php echo number_format($product['precio'], 2); ?></p>
                    <form action="favorites_page.php" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $product['id_producto']; ?>">
                        <button type="submit" name="remove_favorite" class="btn btn-danger">Eliminar de Favoritos</button>
                    </form>
                </div>
                <?php
                    endforeach;
                else:
                    echo "<div class='empty'><p>No tienes productos favoritos guardados.</p></div>";
                endif;
                ?>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
