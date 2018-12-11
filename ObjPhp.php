<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Objeto PHP</h5>               
                <p class="card-text">Clase para modelar las tablas de la BD en el backend</p>
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
                            echo ' <br>';
                            echo 'class ' . $nombreClase . "{<br>";
                            echo '    private $conn;<br>';
                            foreach ($arrCols as $col) {
                                echo '    public $' . $col['COLUMN_NAME'] . ' = "";<br>';
                            }
                            echo '    public $status = 0;<br>';
                            echo '    public $registros = 0;<br>';
                            echo '    public $serial = 0;<br>';
                            echo '    public $mensaje = "";<br>';
                            echo '    public $sql = "";<br>';
                            echo '    public $usuario_app = "";<br>';
                            echo '<br>';
                            echo '<br>';
                            echo '    function __construct($db,$usuario_app) {<br>';
                            echo '        $this->conn = $db;<br>';
                            echo '        $this->usuario_app = $usuario_app;<br>';
                            echo '    }<br>';
                            echo '<br>';


                            echo '    function consulta' . $nombreClase . '($consulta,$totreg, $regini) {<br>';
                            echo '        try {<br>';
                            echo '            $idx2 = strlen($consulta);<br>';
                            echo '            if ($idx2 === 0) {<br>';
                            echo '                $consulta = " 1=1";<br>';
                            echo '            }<br>';
                            echo '            $query = "";<br>';
                            echo '            $query .= "SELECT * FROM ' . $_SESSION['tabla'] . ' ";<br>';
                            echo '            $query .= " WHERE " . $consulta . " ";<br>';
                            foreach ($arrCols as $col) {
                                if (stripos($col['COLUMN_NAME'], 'empresa') !== false) {
                                    echo '            $query .= "  AND ' . $col['COLUMN_NAME'] . ' IN (SELECT aus_empresa FROM usuario,app_ususuc ";<br>';
                                    echo '            $query .= "                      WHERE usu_login = \'" . $this->usuario_app . "\' ";<br>';
                                    echo '            $query .= "                        AND aus_codusuario = usu_codigo ) ";<br>';
                                }
                            }
                            echo '            $query .= " ORDER BY ';
                            $cont = 0;
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] === 'PRI') {
                                    if ($cont > 0) {
                                        echo ',';
                                    }
                                    echo $col['COLUMN_NAME'];
                                    $cont++;
                                }
                            }
                            echo ' ";<br>';
                            echo '            if ($totreg > 0) {<br>';
                            echo '                $query .= " LIMIT $totreg ";<br>';
                            echo '            }<br>';
                            echo '            if ($regini > 0) {<br>';
                            echo '                $query .= " OFFSET $regini ";<br>';
                            echo '            }';
                            echo '<br>';
                            echo '            $this->sql = $query;<br>';
                            echo '            $consPrep = $this->conn->prepare($query);<br>';
                            echo '            $consPrep->execute();<br>';
                            echo '            return $consPrep;<br>';
                            echo '        } catch (Exception $ex) {<br>';
                            echo '            $this->mensaje = $ex->getMessage() . " - Consulta : " . $this->sql;<br>';
                            echo '            throw new Exception($this->mensaje);<br>';
                            echo '        }<br>';
                            echo '    }<br>';
                            echo '<br>';
                            echo '<br>';

                            echo '    function existe' . $nombreClase . '() {<br>';
                            echo '        $idx = 0;<br>';
                            echo '        try {<br>';
                            echo '            $consulta = "";<br>';
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] === 'PRI') {
                                    echo '            if ($this->' . $col['COLUMN_NAME'] . '=== "" || $this->' . $col['COLUMN_NAME'] . '=== null || $this->' . $col['COLUMN_NAME'] . '=== 0) {<br>';
                                    echo '                return false;<br>';
                                    echo '            }<br>';
                                }
                            }
                            $cont = 0;
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] === 'PRI') {
                                    echo '            $consulta .= "';
                                    if ($cont > 0) {
                                        echo ' and ';
                                    }
                                    echo $col['COLUMN_NAME'] . ' = \'" . $this->' . $col['COLUMN_NAME'] . ' . "\' ";<br>';
                                    $cont++;
                                }
                            }
                            echo '            $consPrep = $this->consulta' . $nombreClase . '($consulta);<br>';
                            echo '            if ($consPrep->rowCount() > 0) {<br>';
                            echo '                return true;<br>';
                            echo '            } else {<br>';
                            echo '                return false;<br>';
                            echo '            }<br>';
                            echo '        } catch (Exception $e) {<br>';
                            echo '            throw $e;<br>';
                            echo '        }<br>';
                            echo '    }<br>';
                            echo '<br>';
                            echo '<br>';
                            
                            
                            echo '    function actualiza' . $nombreClase . '() {<br>';
                            echo '        try {<br>';
                            echo '            if ($this->existe' . $nombreClase . '()) {<br>';
                            echo '                $query = "";<br>';
                            echo '                $query .= "UPDATE ' . $_SESSION['tabla'] . ' ";<br>';
                            echo '                $query .= " SET ";<br>';
                            $cont = 0;
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] !== 'PRI') {
                                    echo '                $query .= " ' . $col['COLUMN_NAME'] . ' = \'" . $this->' . $col['COLUMN_NAME'] . '."\',";<br>';
                                }
                            }
                            echo '                $query .= " WHERE ";<br>';
                            $cont = 0;
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] === 'PRI') {
                                    echo '                $query .=  " ';
                                    if ($cont > 0) {
                                        echo ' and ';
                                    }
                                    echo $col['COLUMN_NAME'] . ' = \'" . $this->' . $col['COLUMN_NAME'] . '."\' ";<br>';
                                    $cont++;
                                }
                            }
                            echo '<br>';
                            echo '                $this->sql = $query;<br>';
                            echo '                $stmt = $this->conn->prepare($query);<br>';
                            echo '                $stmt->execute();<br>';
                            echo '                $this->status = 0;<br>';
                            echo '                $this->registros = $stmt->rowCount();<br>';
                            foreach ($arrCols as $col) {
                                if ($col['EXTRA'] === 'auto_increment') {
                                    echo '                $this->serial = $this->' . $col['COLUMN_NAME'] . ';<br>';
                                }
                            }
                            echo '                $this->mensaje = "Registro Actualizado Exitosamente ";<br>';
                            echo '            } else {<br>';
                            echo '                $query = "";<br>';
                            echo '                $query .= "INSERT INTO ' . $_SESSION['tabla'] . ' ";<br>';
                            echo '                $query .= "VALUES ( ";<br>';
                            foreach ($arrCols as $col) {
                                echo '                $query .= "\'" . $this->' . $col['COLUMN_NAME'] . '."\',";<br>';
                            }
                            echo '                $query .= ")";<br>';
                            echo '                $this->sql = $query;<br>';
                            echo '                $stmt = $this->conn->prepare($query);<br>';
                            echo '                $stmt->execute();<br>';
                            echo '                $this->status = 0;<br>';
                            echo '                $this->registros = $stmt->rowCount();<br>';
                            foreach ($arrCols as $col) {
                                if ($col['EXTRA'] === 'auto_increment') {
                                    echo '                $this->serial = $this->conn->lastInsertId();<br>';
                                    echo '                $this->' . $col['COLUMN_NAME'] . ' = $this->serial;<br>';
                                }
                            }
                            echo '                $this->mensaje = "Registro Grabado Exitosamente ";<br>';
                            echo '            }<br>';
                            echo '        } catch (Exception $e) {<br>';
                            echo '            $this->status = -1;<br>';
                            echo '            $this->registros = -1;<br>';
                            echo '            $this->serial = -1;<br>';
                            echo '            $this->mensaje = $e->getMessage() . " - Consulta : " . $this->sql;<br>';
                            echo '            throw new Exception($this->mensaje);<br>';
                            echo '        }<br>';
                            echo '    }<br>';
                            echo '<br>';
                            
                            
                            echo '    function borra' . $nombreClase . '() {<br>';
                            echo '        try {<br>';
                            echo '            $query = "DELETE FROM ' . $_SESSION['tabla'] . '";<br>';
                            echo '            $query .= " WHERE ";<br>';
                            $cont = 0;
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] === 'PRI') {
                                    echo '            $query .= "';
                                    if ($cont > 0) {
                                        echo ' and ';
                                    }
                                    echo $col['COLUMN_NAME'] . ' = \'" . $this->' . $col['COLUMN_NAME'] . '."\' ";<br>';
                                    $cont++;
                                }
                            };
                            echo '            $stmt = $this->conn->prepare($query);<br>';
                            echo '            $stmt->execute();<br>';
                            echo '            return $stmt->rowCount() . " Registro Borrado Exitosamente";<br>';
                            echo '        } catch (Exception $e) {<br>';
                            echo '            $this->status = -1;<br>';
                            echo '            $this->registros = -1;<br>';
                            echo '            $this->serial = -1;<br>';
                            echo '            $mensajeError = $e->getMessage() . " - Consulta : " . $this->sql;<br>';
                            echo '            $this->mensaje = $mensajeError;<br>';
                            echo '            throw new Exception($this->mensaje);<br>';
                            echo '        }<br>';
                            echo '    }<br>';
                            echo '}<br>';                            
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
