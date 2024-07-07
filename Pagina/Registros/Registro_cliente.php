<?php
include './Usuario_funcion.php';
include './conexion_funcion/databases.php';

$db = new Database();
$con = $db->conectar();
$errors = [];

if (!empty($_POST)) {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $edad = trim($_POST['edad']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $cp = trim($_POST['cp']);
    $direccion = trim($_POST['direccion']);
    $calle = trim($_POST['calle']);
    $estado = trim($_POST['estado']);
    $municipio = trim($_POST['municipio']);
    $colonia = trim($_POST['colonia']);
    $referencia = trim($_POST['referencia']);
    $dni = trim($_POST['dni']);
    $password = trim($_POST['Contrasena']);
    $repassword = trim($_POST['password_request']);
    $fecha = date('Y-m-d');

    // Validaciones
    if (esNulo([$nombre, $apellido, $edad, $telefono, $correo, $cp, $direccion, $calle, $estado, $municipio, $colonia, $referencia, $dni, $password, $repassword])) {
        $errors[] = "Rellena todos los datos obligatorios";
    }
    if (!esEmail($correo)) {
        $errors[] = "La dirección de correo no es válida";
    }
    if (!va_password($password, $repassword)) {
        $errors[] = "Verifica tu contraseña";
    }
    if (ExisteEmail($correo, $con)) {
        $errors[] = "Este correo ya está en uso";
    }
    if (ExisteTelefono($telefono, $con)) {
        $errors[] = "Este número ya está en uso";
    }
    if (ExisteDNI($dni, $con)) {
        $errors[] = "Este número de identificación está en uso";
    }

    // Si no hay errores, registrar
    if (count($errors) == 0) {
        $id = registrarCliente([$nombre, $apellido, $edad, $telefono, $correo, $cp, $direccion, $calle, $estado, $municipio, $colonia, $referencia, $dni], $con);

        if ($id > 0) {
            $pass_hash = password_hash($password, PASSWORD_DEFAULT);
            $token = generarToken();

            if (registrarUsuario([$nombre, $pass_hash, $token, $id], $con)) {
                $errors[] = "Registro exitoso.";
            } else {
                $errors[] = "Errores al registrar en login_cliente.";
            }
        } else {
            $errors[] = "Errores al registrar en clientes.";
        }
    }
    
    // Mostrar mensajes de error
    mostrarMess($errors);
}
?>
