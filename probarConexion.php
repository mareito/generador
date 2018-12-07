<?php

$servername = "";
$username = "";
$password = "";
$database = "";

if (isset($_POST['servidor']) && isset($_POST['usuario']) && isset($_POST['base'])) {
    $servername = $_POST['servidor'];
    $username = $_POST['usuario'];
    $database = $_POST['base'];
    if (isset($_POST['clave'])) {
        $password = $_POST['clave'];
    }
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$base", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);        
        echo "<script>"
        . "localStorage.setItem('servidor','$servername');" 
        . "window.alert('Conexion correcta');"
        . "window.location.replace('index.php?opc=1&con=1');"        
        . "</script>";
    } catch (PDOException $e) {
        echo "<script>window.alert('Error en la Conexion');window.location.replace('index.php?opc=1&con=0')</script>";
    }
}else{
    echo "<script>window.alert('No se Enviaron Parametros');window.location.replace('index.php?opc=1&con=0')</script>";
}
?>
