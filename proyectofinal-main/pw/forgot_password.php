<?php
include 'config.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50));

    // Actualiza la base de datos con el token de restablecimiento de contraseña
    $stmt = $conn->prepare("UPDATE Usuarios SET reset_token = ? WHERE email = ?");
    $stmt->bind_param("ss", $token, $email);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Cambia esto a tu servidor SMTP real
            $mail->SMTPAuth = true;
            $mail->Username = 'tu-email@gmail.com';  // Tu dirección de correo electrónico
            $mail->Password = 'tu-contraseña';  // Tu contraseña o contraseña de aplicación
            $mail->SMTPSecure = 'tls';  // Cifrado: 'tls' o 'ssl'
            $mail->Port = 587;  // Puerto: 587 para TLS, 465 para SSL

            // Configuración del correo electrónico
            $mail->setFrom('no-reply@protech.com', 'ProTech');
            $mail->addAddress($email);
            $mail->Subject = 'Restablecer contraseña';
            $mail->Body = "Haz clic en el siguiente enlace para restablecer tu contraseña: http://tu-dominio.com/reset_password.php?token=$token";

            $mail->send();
            echo "Correo enviado.";
        } catch (Exception $e) {
            echo "Error al enviar correo: {$mail->ErrorInfo}";
        }
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
    <title>Olvidar Contraseña</title>
</head>
<body>
    <form method="POST" action="forgot_password.php">
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>

