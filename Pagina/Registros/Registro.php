<?php
include("./conexion_funcion/conex.php");

if(isset($_POST["registro"])){
   if(
    strlen($_POST['nombre']) >= 1 &&
    strlen($_POST['apellido']) >= 1 &&
    strlen($_POST['edad']) >= 1 &&
    strlen($_POST['telefono']) >= 1 &&
    strlen($_POST['correo']) >= 1 &&
    strlen($_POST['cp']) >= 1 &&
    strlen($_POST['direccion']) >= 1 &&
    strlen($_POST['calle']) >= 1 &&
    strlen($_POST['estado']) >= 1 &&
    strlen($_POST['municipio']) >= 1 &&
    strlen($_POST['colonia']) >= 1 &&
    strlen($_POST['referencia']) >= 1 &&
    strlen($_POST['dni']) >= 1
   ){
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
    $fecha = date('Y-m-d'); // Usando formato de fecha estándar

    // Agrega una función de depuración para verificar los datos recibidos
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $consulta = "INSERT INTO clientes (Nombre_Usi, Apellido, Edad, Telefono, Correo, CP, Direcion, calle, Estado, Municipio, Colonia, Referencia, DNI, fecha_alta) 
    
    VALUES ('$nombre', '$apellido', '$edad', '$telefono', '$correo', '$cp', '$direccion', '$calle', '$estado', '$municipio', '$colonia', '$referencia', '$dni', '$fecha')";

    $resultado = mysqli_query($conexion, $consulta);

    if($resultado){
        echo "<h3 class='success'>Tu registro fue completo</h3>";
    } else {
        echo "<h3 class='error'>Tu registro fue incompleto</h3>";
    }
   }
}
?>
