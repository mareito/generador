<?php
session_start();
$servidor = "";
$usuario = "";
$clave = "";
$base = "";

if (isset($_POST['servidor']) && isset($_POST['usuario']) && isset($_POST['base'])) {
    $servidor = $_POST['servidor'];
    $usuario = $_POST['usuario'];
    $base = $_POST['base'];
    if (isset($_POST['clave'])) {
        $clave = $_POST['clave'];
    }
    try {
        echo "<script>"
        . "localStorage.removeItem('servidor');"
        . "localStorage.removeItem('base');"
        . "localStorage.removeItem('usuario');"
        . "localStorage.removeItem('clave');"
        . "</script>";     
        $conn = new PDO("mysql:host=" . $servidor . ";dbname=" . $base, $usuario, $clave, array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));        
        echo "<script>"
        . "localStorage.setItem('servidor','$servidor');"
        . "localStorage.setItem('base','$base');"
        . "localStorage.setItem('usuario','$usuario');"
        . "localStorage.setItem('clave','$clave');"
        . "window.alert('Conexion correcta');"
        . "window.location.replace('index.php?opc=1&con=1&val=1');"
        . "</script>";
        $_SESSION['servidor'] = $servidor;
        $_SESSION['base'] = $base;
        $_SESSION['usuario'] = $usuario;
        $_SESSION['clave'] = $clave;
    } catch (PDOException $e) {
        echo "<script>window.alert('Error en la Conexion : $e->getMessage()');window.location.replace('index.php?opc=1&con=0&val=1')</script>";
    }
} else {
    echo "<script>window.alert('No se Enviaron Parametros');window.location.replace('index.php?opc=1&con=0&val=1')</script>";
}
?>
