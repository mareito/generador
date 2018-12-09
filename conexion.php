<br>
<br>
<?php
$conexion = 0;
$validado = 0;
if (isset($_GET['con'])) {
    $conexion == intval($_GET['con']);
}
if (isset($_GET['val'])) {
    $validado == intval($_GET['val']);
}
?>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Parametros de Conexion</h5>        
                <form  action="probarConexion.php" method="post">
                    <div class="form-group">
                        <label for="servidor">Servidor</label>
                        <input type="text" class="form-control" name="servidor" id="servidor" aria-describedby="servidorHelp" placeholder="Nombre / IP Servidor" required>
                        <small id="servidorHelp" class="form-text text-muted">Servidor para Hacer la conexión</small>
                    </div>
                    <div class="form-group">
                        <label for="base">Base de Datos</label>
                        <input type="text" class="form-control" name="base" id="base" aria-describedby="baseHelp" placeholder="Nombre Base de Datos" required>
                        <small id="baseHelp" class="form-text text-muted">Nombre de la base de datos</small>
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
                    </div>           
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="password" class="form-control" name="clave" id="clave" placeholder="clave">
                    </div>                                            
                    <input type="hidden" class="form-control" name="conexion" id=conexion value="<?php echo $conexion ?>">
                    <input type="submit" value="Guardar" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div id="resultado">
            <?php
            if ($validado > 0) {
                if ($conexion > 0) {
                    echo '<span>Conexion Realizada Correctamente</span>';
                } else {
                    echo '<span>Conexion no se pudo realizar</span>';
                }
            }
            ?>
        </div>
    </div>
    <div class="col"></div>
</div>

