<?php
include './Usuario_funcion.php';
include './conexion_funcion/databases.php';
$db = new Database();
$con = $db->conectar();
$errors = [];
if (!empty($_POST)) {
    $nombre = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (esNulo([$nombre, $password])) {
        $errors[] = "Rellena todos los datos obligatorios";
    }
if(count($errors)==0){
$errors[]=login($nombre,$password,$con);}
}
mostrarMess($errors);
    ?>