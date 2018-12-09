<?php
session_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <title>Generador de Código</title>
    </head>
    <body>   
        <small>
            <?php
            include './menu.php';
            ?>
            <div class="container-fluid">         
                <?php
                $opc = 0;
                if (isset($_GET['opc'])) {
                    $opc = intval($_GET['opc']);
                }
                if (!isset($_SESSION['servidor']) && !isset($_SESSION['base']) &&
                        !isset($_SESSION['usuario']) && !isset($_SESSION['clave'])) {
                    $opc = 0;
                    echo "<script>"
                    . "localStorage.removeItem('servidor');"
                    . "localStorage.removeItem('base');"
                    . "localStorage.removeItem('usuario');"
                    . "localStorage.removeItem('clave');"
                    . "</script>";
                }
                switch ($opc) {
                    case 1:
                        include './conexion.php';
                        break;
                    case 2:
                        include './tabla.php';
                        break;
                    default :
                        include './conexion.php';
                        break;
                }
                ?>
            </div>
        </small>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->     
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
</html>