<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = hashPassword($_POST['new_password']);

    $stmt = $conn->prepare("UPDATE Usuarios SET contraseña = ?, reset_token = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $new_password, $token);

    if ($stmt->execute()) {
        echo "Contraseña restablecida.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
</head>
<body>
    <form method="POST" action="reset_password.php">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" required><br>
        <input type="password" name="new_password" placeholder="Nueva Contraseña" required><br>
        <button type="submit">Restablecer</button>
    </form>
</body>
</html>