<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Generador</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=1">Conexión<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Tabla<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=3">Objeto Conn<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=4">Objeto PHP<span class="sr-only">(current)</span></a>
            </li>         
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=5">Servicio PHP<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Template Angular<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Componente Angular<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Servicio Angular<span class="sr-only">(current)</span></a>
            </li>  
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Clase Angular<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Pipe Angular<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<?php
if (isset($_SESSION['servidor']) && isset($_SESSION['base'])) {
    echo '<nav aria-label="breadcrumb">';
    echo '    <ol class="breadcrumb">';
    echo '        <li class="breadcrumb-item">' . $_SESSION['servidor'] . '</li>';
    echo '        <li class="breadcrumb-item">' . $_SESSION['base'] . '</li>';
    if (isset($_SESSION['tabla'])) {
        echo '        <li class="breadcrumb-item">' . $_SESSION['tabla'] . '</li>';
    }
    echo '    </ol>';
    echo '</nav>';
}
?>

