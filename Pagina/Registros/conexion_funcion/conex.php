<?php
$db="localhost";
$user="root";
$pass="";
$bt="usuario";

$conexion=mysqli_connect($db, $user, $pass, $bt);

if($conexion->connect_errno){
    die("Falló la conexión: ".$conexion->connect_errno);
} else {
    echo "Conexión exitosa";
}
?>
