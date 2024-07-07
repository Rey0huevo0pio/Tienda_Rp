<?php
class Database{
    private $hostname="localhost";
    private $database="base_tienda";  // Asegúrate de que esta sea la base de datos correcta
    private $username="root";
    private $password="";
    private $charset="utf8";
  
    public function conectar()
    {
        try {
            $conexion = "mysql:host=" . $this->hostname . ";dbname=" . $this->database . ";charset=" . $this->charset;
       
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            $pdo = new PDO($conexion, $this->username, $this->password, $options);
            echo "CONEXI: ";
            return $pdo;
        } catch (PDOException $e) {
            echo 'ERROR DE CONEXION: ' . $e->getMessage();
            exit;
        }
    }
}
$db = new Database();
$db->conectar();
?>
