<br>
<br>
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
                    <input type="submit" value="Probar" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div id="resultado"></div>
    </div>
    <div class="col"></div>
</div>

