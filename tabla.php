<?php
if (isset($_GET['tabla'])) {
    $_SESSION['tabla'] = $_GET['tabla'];
}
?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Parametros de Conexion</h5>                       
                <div class="form-group">
                    <label for="servidor">Servidor</label>
                    <input type="text" class="form-control" name="servidor" id="servidor" value="<?php echo $_SESSION['servidor']; ?>" aria-describedby="servidorHelp" placeholder="Nombre / IP Servidor" disabled="true">                        
                </div>
                <div class="form-group">
                    <label for="base">Base de Datos</label>
                    <input type="text" class="form-control" name="base" id="base" value="<?php echo $_SESSION['base']; ?>" aria-describedby="baseHelp" placeholder="Nombre Base de Datos" disabled>                        
                </div>     
                 <?php 
                         if(isset($_SESSION['tabla'])){
                            echo '<div class="form-group">';
                            echo '<label for="base">Tabla Seleccionada</label>';
                            echo '<input type="text" class="form-control" name="tabla" id="tabla" value="' . $_SESSION['tabla'] . '" disabled>';                        
                            echo '</div>';             
                         }
                 ?>
                     
            </div>
        </div> 
    </div>
    <div class="col">      
        <?php
        $conn = "";
        include './bd.php';
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '" . $_SESSION['base'] . "' ORDER BY table_name ";
        //$sql = "select * from tipoproceso ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo '<table class="table table-bordered table-striped table-hover" style="width:100%">';
        echo '<thead class="thead-light">';
        echo '<tr>';
        echo '<th scope="col">Nombre de la Tabla</th>';
        echo '<th scope="col">Nro Registros</th>';
        echo '<th scope="col">Ultimo Serial</th>';
        echo '<th scope="col">Comentario</th>';
        echo '<th scope="col">Seleccionar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($result as $reg) {
            echo '<tr>';
            echo '<td>' . $reg['TABLE_NAME'] . '</td>';
            echo '<td>' . $reg['TABLE_ROWS'] . '</td>';
            echo '<td>' . $reg['AUTO_INCREMENT'] . '</td>';
            echo '<td>' . $reg['TABLE_COMMENT'] . '</td>';
                    if(isset($_SESSION['tabla']) && $_SESSION['tabla'] == $reg['TABLE_NAME']){
                        echo '<td></td>';
                    }else{
                        echo '<td><a class="btn btn-outline-primary btn-sm" href="index.php?opc=2&tabla=' . $reg['TABLE_NAME'] . '">Seleccionar</a></td>';
                    }
            
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>'
        ?>
    </div>
    <div class="col">        
    </div>
</div>
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