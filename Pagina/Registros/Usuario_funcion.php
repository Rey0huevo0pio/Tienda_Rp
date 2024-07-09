<?php
function esNulo(array $parametro)
{
    foreach ($parametro as $parametro) {
        if ($parametro == null || $parametro == '') {
            return true;
        }
    }
    return false;
}

function esEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    }
    return false;
}

function va_password($password, $repassword)
{
    if (strcmp($password, $repassword) !== 0) {
        return false;
    }
    return true;
}

function generarToken()
{
    return md5(uniqid(mt_rand(), false));
}

function registrarCliente(array $datos, $con)
{
    $sql = $con->prepare("INSERT INTO usuarios (Nombre_Usi, Apellido, Edad, Telefono, Correo, CP, Direcion, Calle, Estado, Municipio, Colonia, Referencia, DNI, Estatus, Fecha_Alta) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, now())");

    if ($sql->execute($datos)) {
        return $con->lastInsertId();
    }
    return 0;
}

function registrarUsuario(array $datos, $con)
{
    $sql = $con->prepare("INSERT INTO login_cliente (Nombre, Contrasena, token, Id_usuarios) VALUES (?, ?, ?, ?)");

    if ($sql->execute($datos)) {
        return true;
    }
    return false;
}
function ExisteEmail($email, $con)
{
    $sql = $con->prepare("SELECT ID from usuarios where Correo = ? limit 1");
    $sql->execute([$email]);
    if ($sql->fetchColumn() > 0) {
        return true;
    }
    return false;
}
function ExisteTelefono($telefono, $con)
{
    $sql = $con->prepare("SELECT ID from usuarios where Telefono = ? limit 1");
    $sql->execute([$telefono]);
    if ($sql->fetchColumn() > 0) {
        return true;
    }
    return false;
}
function ExisteDNI($dni, $con)
{
    $sql = $con->prepare("SELECT ID from usuarios where DNI = ? limit 1");
    $sql->execute([$dni]);
    if ($sql->fetchColumn() > 0) {
        return true;
    }
    return false;
}
function mostrarMess(array $errors)
{
    if (count($errors) > 0) {
        echo '<div class="alert alert-primary" role="alert">';
        echo '<ul>';
        foreach ($errors as $error) {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
    }
}

function actiCuenta($id, $con)
{
    $sql = $con->prepare("UPDATE login_cliente SET activacion=1 WHERE id=?");
    return $sql->execute([$id]);
}


function login($nombre, $password, $con)
{
    // Iniciar la sesión si aún no se ha iniciado
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $sql = $con->prepare("SELECT id, Nombre, Contrasena FROM login_cliente WHERE Nombre LIKE ? LIMIT 1");
    $sql->execute([$nombre]);

    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        if (Usur_activo($nombre, $con)) {



            if (password_verify($password, $row['Contrasena'])) {
                // Almacenar los datos de usuario en la sesión
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_name'] = $row['Nombre'];

                // Redirigir a la página inicial
                header("Location: ../index.php");
                exit;
            }
        }else{
            return 'El usuario no existe';
        }
    }
    return 'El nombre y/o contraseña es incorrecto ¿(._.)?';
}
function Usur_activo($nombre, $con)
{
    $sql = $con->prepare("SELECT activacion FROM login_cliente WHERE Nombre like ? LIMIT 1");
    $sql->execute([$nombre]);
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    if ($row['activacion'] == 1) {
        return true;
    }
    return false;
}
