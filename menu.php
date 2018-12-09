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
                <a class="nav-link" href="index.php?opc=2">Objeto Conn<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Objeto Resp<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=3">Conector BD<span class="sr-only">(current)</span></a>
            </li>  
            <li class="nav-item active">
                <a class="nav-link" href="index.php?opc=2">Servicio PHP<span class="sr-only">(current)</span></a>
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
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><span id="servidor"></span></li>
        <li class="breadcrumb-item active" aria-current="page"><span id="base"></span></li>
    </ol>
</nav>
<?php
echo "<script>";
echo "if(localStorage.getItem('servidor')){";
echo "  document.getElementById('servidor').innerHTML = localStorage.getItem('servidor') ";
echo "}";
echo "if(localStorage.getItem('base')){";
echo "  document.getElementById('base').innerHTML = localStorage.getItem('base') ";
echo "}";
echo '</script>'
?>

