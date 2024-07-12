<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar las credenciales del usuario
    $stmt = $conn->prepare("SELECT id_usuario, nombre, email, contraseña FROM Usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id_usuario, $nombre, $email, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Guardar la información del usuario en la sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['id_usuario'] = $id_usuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $email;
            
            // Redirigir a la página de perfil
            header("location: profile.php");
        } else {
            $error = "Correo o contraseña incorrectos.";
        }
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <style>
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container .form-group label {
            font-weight: bold;
        }

        .login-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .login-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
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
                    <li class="nav-item"><a class="nav-link text-white" href="login.php">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="register.php">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mt-5">
        <div class="login-container bg-light p-4">
            <h2 class="text-center">Iniciar Sesión</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <form action="login.php" method="post" class="mt-4">
                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </form>
        </div>
    </main>

    <footer class="bg-dark text-white text-center p-3 mt-5">
        <p class="mb-0">&copy; 2024 MayShop. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
