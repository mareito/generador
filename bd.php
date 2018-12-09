<?php
$conn = new PDO("mysql:host=" . $_SESSION['servidor'] . ";dbname=" . $_SESSION['base'], $_SESSION['usuario'], $_SESSION['clave'], array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));
