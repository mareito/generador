<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Clase Modelo de Angular</h5>               
                <p class="card-text">Clase para modelar los objetos en Angular</p>
                <hr>
                <div class="alert alert-primary" role="alert">
                    <pre>
                        <?php
                        include './bd.php';
                        include './funciones.php';
                        $sql = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . $_SESSION['base'] . "' and TABLE_NAME = '" . $_SESSION['tabla'] . "'" .
                                "ORDER BY ORDINAL_POSITION ";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $arrCols = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $tot = 0;
                        $nombreClase = ucfirst($_SESSION['tabla']);
                        if (tienePk($arrCols)) {
                            echo '<br>';
                            echo 'export class ' . $nombreClase . ' {<br>';
                            foreach ($arrCols as $columnas) {
                                echo '    ' . $columnas['COLUMN_NAME'] . ':' . tipoDatoAngular($columnas['DATA_TYPE']);
                                echo ';<br>';
                            }
                             echo '<br>';
                            echo '    constructor(){<br>';                           
                            foreach ($arrCols as $columnas) {
                                echo '        this.' . $columnas['COLUMN_NAME'] . ' = ' . iniciaDatoAngular($columnas['DATA_TYPE']);
                                echo ';<br>';
                            }
                            echo '    }<br>';
                            echo '}<br>';
                            echo '<br>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">';
                            echo 'La Tabla no tiene llave primaria';
                            echo '</div>';
                        }
                        ?>
                    </pre>
                </div>
            </div>
        </div>
    </div>   
</div>

