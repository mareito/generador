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
                            $dirClases = "";
                            if (isset($_SESSION['clases'])) {
                                $dirClases = $_SESSION['clases'] . "/";
                            }
                            echo '<br>';
                            echo 'header("Access-Control-Allow-Origin: *");<br>';
                            echo 'header("Content-Type: application/json; charset=UTF-8");<br>';
                            echo 'ini_set("date.timezone", "America/Bogota");<br>';
                            echo '<br>';
                            echo '<br>';
                            echo 'try {<br>';
                            echo '    include_once "' . $dirClases . 'connDB.php";<br>';
                            echo '    include_once "' . $dirClases . 'respuesta.php";<br>';
                            echo '    include_once "' . $dirClases . 'funciones.php";<br>';
                            echo '    include_once "' . $dirClases . $nombreClase . '.php";<br>';
                            echo '<br>';
                            echo '<br>';
                            echo '    $objeto = json_decode(file_get_contents("php://input"));<br>';
                            echo '    $accion = $objeto->accion;<br>';
                            echo '    $token = $objeto->token;<br>';
                            echo '    $data = $objeto->data;<br>';
                            echo '    $database = new Database();<br>';
                            echo '    $db = $database->getConnection();<br>';
                            echo '    $respuesta = new Respuesta();<br>';
                            echo '    $funciones = new Funciones();<br>';
                            echo '    $usu = new Usuario($db);<br>';
                            echo '    $' . $_SESSION['tabla'] . ' = new ' . $nombreClase . '($db);<br>';
                            echo '    $transaccion = "N";<br>';
                            echo '    $tranOk = true;<br>';
                            echo '<br>';
                            echo '    if ($usu->existeToken($token)) {<br>';
                            echo '        if ($accion === "CO") {<br>';
                            echo '             $totreg = 0;<br>';
                            echo '             $regini = 0;<br>';
                            echo '             if($objeto->totalRegistros){<br>';
                            echo '                 $totreg = intval($objeto->totalRegistros);<br>';
                            echo '             }<br>';
                            echo '             if($objeto->registroInicial){<br>';
                            echo '                 $regini = intval($objeto->registroInicial);<br>';
                            echo '             }<br>';
                            echo '             $arreglo = $' . $_SESSION['tabla'] . '->consulta' . $nombreClase . '($respuesta->setSqlJson($data),$totreg,$regini);<br>';
                            echo '             $respuesta->setSql($' . $_SESSION['tabla'] . '->sql);<br>';
                            echo '             $respuesta->setTot($arreglo->rowCount());<br>';
                            echo '             if ($respuesta->getTot() > 0) {<br>';
                            echo '                 $registros = $arreglo->fetchAll(PDO::FETCH_ASSOC);<br>';
                            echo '                 $respuesta->setDatos(\'registros\', $registros)<br>';
                            echo '                 $respuesta->setStatus($' . $_SESSION['tabla'] . '->status);<br>';
                            echo '                 $respuesta->setMensaje($' . $_SESSION['tabla'] . '->mensaje);<br>';
                            echo '                 $respuesta->setRegConsulta($' . $_SESSION['tabla'] . '->totalRegistros($respuesta->setSqlJson($data)));<br>';
                            echo '             }<br>';
                            echo '        }<br>';
                            echo '<br>';
                            echo '        if ($accion === \'GR\') {<br>';
                            echo validaReferencias($conn, $_SESSION['base'], $_SESSION['tabla'], $nombreClase);
                            echo '            $hora = time();<br>';
                            echo '            $db->beginTransaction();<br>';
                            echo '            $transaccion = \'S\';<br>';
                            echo '            $par' . $nombreClase . ' = $objeto->par' . $nombreClase . ';<br>';
                            foreach ($arrCols as $col) {
                                if (stripos($col['COLUMN_NAME'], 'usureg') !== false) {
                                    echo '            $obj' . $nombreClase . '->' . $col['COLUMN_NAME'] . ' = $usuario_app;';
                                } else {
                                    if (stripos($col['COLUMN_NAME'], 'fechareg') !== false) {
                                        echo '            $obj' . $nombreClase . '->' . $col['COLUMN_NAME'] . ' = date(\'Y-m-d\',$hora);';
                                    } else {
                                        if (stripos($col['COLUMN_NAME'], 'horareg') !== false) {
                                            echo '            $obj' . $nombreClase . '->' . $col['COLUMN_NAME'] . ' = date(\'H:i:s\',$hora);';
                                        } else {
                                            echo '            $obj' . $nombreClase . '->' . $col['COLUMN_NAME'] . ' = $par' . $nombreClase . '->' . $col['COLUMN_NAME'] . ';';
                                        }
                                    }
                                }
                                echo '<br>';
                            }
                            echo '            $' . $_SESSION['tabla'] . '->actualiza' . $nombreClase . '();<br>';
                            echo '            $respuesta->setMensaje($' . $_SESSION['tabla'] . '->mensaje);<br>';
                            echo '            if ($' . $_SESSION['tabla'] . '->status === 200 || $' . $_SESSION['tabla'] . '->status === 0) {<br>';
                            echo '                $respuesta->setStatus($' . $_SESSION['tabla'] . '->status);<br>';
                            echo '                $respuesta->setTot($' . $_SESSION['tabla'] . '->registros);<br>';
                            echo '                $respuesta->setMensaje($' . $_SESSION['tabla'] . '->mensaje);<br>';
                            echo '                $respuesta->setSerial($' . $_SESSION['tabla'] . '->serial);<br>';
                            echo '                $db->commit();<br>';
                            echo '            } else {<br>';
                            echo '                $respuesta->setStatus(-1);<br>';
                            echo '                $respuesta->setMensaje("Error " . $' . $_SESSION['tabla'] . '->mensaje);<br>';
                            echo '                $db->rollback();<br>';
                            echo '            }<br>';
                            echo '        }<br>';
                            echo '    } else {;<br>';
                            echo '        $respuesta->setStatus(-999);<br>';
                            echo '        $respuesta->setMensaje("Error->Usuario Invalido");<br>';
                            echo '    }<br>';
                            echo '    echo $respuesta->getRespuesta();<br>';
                            echo '} catch (Exception $ex) {<br>';
                            echo '    if ($transaccion === \'S\') {<br>';
                            echo '        $db->rollback();<br>';
                            echo '    }<br>';
                            echo '    $respuesta = new Respuesta();<br>';
                            echo '    $respuesta->setStatus(-1);<br>';
                            echo '    $respuesta->setMensaje("Error->" . $ex->getMessage());<br>';
                            echo '    echo $respuesta->getRespuesta();<br>';
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
