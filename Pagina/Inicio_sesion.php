<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MayShop</title>
    <link rel="stylesheet" href="./pain/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>

<video autoplay muted loop class="mivideo">
    <source src="./disan_css/9150545-hd_1920_1080_24fps.mp4" type="video/mp4">
    Tu navegador no soporta la reproducción de video.
</video>

<div class="content">
    <header>
        <h1>MayShop</h1>
        <div class="user-options">
            <a href="./inicio.html"><span class="material-icons"></span>Página inicial</a>
            <a href="../index.html"><span class="material-icons"></span>Saber más...</a>
        </div>

    </header>
    <section class="login-container">
        <form method="post" action="./Registros/Registro_cliente.php" class="login-form" id="form" autocomplete="on" >
            <h2>Iniciar Sesión</h2>
            <label for="username">Usuario</label>
            <input type="text" id="username" name="username" requireda>
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" requireda>
            <input class="btn" type="submit" name="registro" value="Enviar">
            <a href="#">¿Ol?</a>
            <a href="./Registro_V_U.html" class="toggle-form" id="toggleForm">Crear una cuenta...</a>
        </form>      
      

</body>
</html>
