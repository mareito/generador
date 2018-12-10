<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Objeto Conexión</h5>               
                <p class="card-text">Clase que permite realizar la conexión con la base de datos seleccionada</p>
                <hr>
                <div class="alert alert-primary" role="alert">
                    <pre>
                        <?php
                        
                        echo '<br>';
                        echo 'class Database {<br>';
                        echo '<br>';
                        echo '    public $host = "' . $_SESSION['servidor'] . '";<br>';
                        echo '    public $db_name = "' . $_SESSION['base'] . '";<br>';
                        echo '    private $username = "' . $_SESSION['usuario'] . '";<br>';
                        echo '    private $password = "' . $_SESSION['clave'] . '";<br>';
                        echo '    private $conn;<br>';
                        echo '<br>';
                        echo '   // Constructor de la clase<br>';
                        echo '    function Database() { <br>';
                        echo '<br>';
                        echo '    }<br>';
                        echo '<br>';
                        echo '    // Establece la conexion y retorna el objeto PDO de conexion <br>';
                        echo '    function getConnection() { <br>';
                        echo '        $this->conn = null;<br>';
                        echo '        try {<br>';
                        echo '            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(<br>';
                        echo '                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,<br>';
                        echo '                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"<br>';
                        echo '            ));<br>';
                        echo '        } catch (Exception $ex) {<br>';
                        echo '            throw new Exception(\'Error en la conexion->\' . \' \' . $ex->getMessage());<br>';
                        echo '        }<br>';
                        echo '<br>';
                        echo '        return $this->conn;<br>';
                        echo '    }<br>';
                        echo '<br>';
                         echo '   // Consulta si el token pertenece a algun usuario de la aplicacion <br>';
                        echo '    function tokenValido($token) {<br>';
                        echo '        try {<br>';
                        echo '            $sql = "SELECT * FROM usuario ";<br>';
                        echo '            $sql .= " WHERE usu_token = \'" . $token . "\' ";<br>';
                        echo '            $consPrep = $this->conn->prepare($sql);<br>';
                        echo '            $consPrep->execute();<br>';
                        echo '            if ($consPrep->rowCount() > 0) {<br>';
                        echo '                return false;<br>';
                        echo '            } else {<br>';
                        echo '                return true;<br>';
                        echo '            }<br>';
                        echo '        } catch (Exception $ex) {<br>';
                        echo '            throw new Exception(\'Error al consultar el token->\' . $ex->getMessage());<br>';
                        echo '        }<br>';
                        echo '    }<br>';
                        echo '<br>';
                        echo '    // Genera token aleatorio para la validacion del usuario <br>';
                        echo '    function generarToken() {<br>';
                        echo '        try {<br>';
                        echo '            $cont = 0;<br>';
                        echo '            while (true) {<br>';
                        echo '                $token = str_shuffle("AbcdefghIjklMnOpqRstuvwxyz0123456789" . uniqid());<br>';
                        echo '                $cont += 1;<br>';
                        echo '                if ($this->tokenValido($token)) {<br>';
                        echo '                    return $token;<br>';
                        echo '                }<br>';
                        echo '                if ($cont === 5) {<br>';
                        echo '                    throw new Exception(\'No se pudo generar el token\');<br>';
                        echo '                }<br>';
                        echo '            }<br>';
                        echo '        } catch (Exception $ex) {<br>';
                        echo '            throw new Exception(\'Error al generar el token ->\' . $ex->getMessage());<br>';
                        echo '        }<br>';
                        echo '    }<br>';
                        echo '<br>';
                        echo '   // Ejecuta la consulta sin retornar nada.  Para insert, update, delete, etc <br>';
                        echo '    function ejecutaSql2($pSql) {<br>';
                        echo '        try {<br>';
                        echo '            $consPrep = $this->conn->prepare($pSql);<br>';
                        echo '            $consPrep->execute();<br>';
                        echo '        } catch (Exception $ex) {<br>';
                        echo '            throw $ex;<br>';
                        echo '        }<br>';
                        echo '    }<br>';
                        echo '<br>';
                        echo '    // Realiza la consulta y retorna el numero de registros consultados<br>';
                        echo '    function ejecutaSql3($pSql) {<br>';
                        echo '        try {<br>';
                        echo '            $consPrep = $this->conn->prepare($pSql);<br>';
                        echo '            $consPrep->execute();<br>';
                        echo '            return $consPrep->rowCount();<br>';
                        echo '        } catch (Exception $ex) {<br>';
                        echo '            throw $ex;<br>';
                        echo '        }<br>';
                        echo '    }<br>';
                        echo '<br>';
                        echo '   // Realiza la consulta y retorna un arreglo asociativo con el resultado<br>';
                        echo '    function ejecutaSql($pSql) {<br>';
                        echo '        try {<br>';
                        echo '            $consPrep = $this->conn->prepare($pSql);<br>';
                        echo '            $consPrep->execute();<br>';
                        echo '            $tot = $consPrep->rowCount();<br>';
                        echo '            $registros = array();<br>';
                        echo '            if ($tot > 0) {<br>';
                        echo '                $registros = $consPrep->fetchAll(PDO::FETCH_ASSOC);<br>';
                        echo '            }<br>';
                        echo '            return $registros;<br>';
                        echo '        } catch (Exception $ex) {<br>';
                        echo '            throw $ex;<br>';
                        echo '        }<br>';
                        echo '    }<br>';
                        echo '<br>';
                        echo '}<br>';
                        ?>
                    </pre>
                </div>
            </div>
        </div>
    </div>   
</div>



