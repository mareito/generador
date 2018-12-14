<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Template HTML Angular</h5>               
                <p class="card-text">Template HTML para el Componente de Angular </p>
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
                            echo htmlspecialchars('<section class="container-fluid margen-sup">') . '<br>';
                            echo htmlspecialchars('    <header class="content__title">') . '<br>';
                            echo htmlspecialchars('        <h1>') . ucwords($nombreClase) . htmlspecialchars('<h1>') . '<br>';
                            echo htmlspecialchars('        <div class="actions">') . '<br>';
                            echo htmlspecialchars('            <a class="actions__item zmdi zmdi-file-plus zmdi-hc-fw" (click)="mostrarForma()" *ngIf="!verForma"></a>') . '<br>';
                            echo htmlspecialchars('            <a class="actions__item zmdi zmdi-long-arrow-left zmdi-hc-fw" (click)="ocultarForma()" *ngIf="verForma"></a>') . '<br>';
                            echo htmlspecialchars('        </div>') . '<br>';
                            echo htmlspecialchars('     </header>') . '<br>';
                            echo htmlspecialchars('     <hr>') . '<br>';
                            echo htmlspecialchars('     <div class="card animated fadeIn" *ngIf="!verForma && arr') . $nombreClase . htmlspecialchars('.length > 0 && !cargando">') . '<br>';
                            echo htmlspecialchars('         <div class="card-header">') . '<br>';
                            echo htmlspecialchars('             descripcion de la opcion') . '<br>';
                            echo htmlspecialchars('         </div>') . '<br>';
                            echo htmlspecialchars('         <div class="card-body">') . '<br>';
                            echo htmlspecialchars('             <div class="table-responsive">') . '<br>';
                            echo htmlspecialchars('                 <table class="table table-hover table-stripped table-compact">') . '<br>';
                            echo htmlspecialchars('                     <thead class="table-inverse">') . '<br>';
                            echo htmlspecialchars('                         <tr>') . '<br>';
                            echo htmlspecialchars('                              <td>#</td>') . '<br>';
                            foreach ($arrCols as $columnas) {
                                echo htmlspecialchars('                              <td>') . $columnas['COLUMN_COMMENT'] . htmlspecialchars('<td>') . '<br>';
                            }
                            echo htmlspecialchars('                         </tr>') . '<br>';
                            echo htmlspecialchars('                     </thead>') . '<br>';
                            echo htmlspecialchars('                     <tbody>') . '<br>';
                            echo htmlspecialchars('                         <tr *ngFor="let obj') . $nombreClase . ' of arr' . $nombreClase . '; let idx = index">' . '<br>';
                            echo htmlspecialchars('                             <td>{{idx+1}}</td>') . '<br>';
                            foreach ($arrCols as $columnas) {
                                echo htmlspecialchars('                             <td>{{obj') . $nombreClase . '.' . $columnas['COLUMN_NAME'] . htmlspecialchars('}}</td>') . '<br>';
                            }
                            echo htmlspecialchars('                             <td>') . '<br>';
                            echo htmlspecialchars('                                 <div class="btn-group btn-group-sm">') . '<br>';
                            echo htmlspecialchars('                                 <button type="button" class="btn btn-light" (click)="editar') . $nombreClase . '(obj' . $nombreClase . htmlspecialchars(')">Editar</button>') . '<br>';
                            echo htmlspecialchars('                             </td>') . '<br>';
                            echo htmlspecialchars('                         </tr>') . '<br>';
                            echo htmlspecialchars('                    </tbody') . '<br>';
                            echo htmlspecialchars('                </table>') . '<br>';
                            echo htmlspecialchars('            </div>') . '<br>';
                            echo htmlspecialchars('        </div>') . '<br>';
                            echo htmlspecialchars('    </div>') . '<br>';
                            echo htmlspecialchars('    <div class="card animated fadeIn" *ngIf="!verForma && cargando" >') . '<br>';
                            echo htmlspecialchars('        <div class="card-body text-center">') . '<br>';
                            echo htmlspecialchars('            <h6>Cargando Informacion ... </h6>') . '<br>';
                            echo htmlspecialchars('        </div>') . '<br>';
                            echo htmlspecialchars('        <div class="card animated fadeIn" *ngIf="!verForma && arr') . $nombreClase . htmlspecialchars('.length === 0 && !cargando " >') . '<br>';
                            echo htmlspecialchars('            <div class="card-body text-center">') . '<br>';
                            echo htmlspecialchars('               <h6>No Existen Registros para Mostrar</h6>') . '<br>';
                            echo htmlspecialchars('               </div>') . '<br>';
                            echo htmlspecialchars('            </div>') . '<br>';
                            echo htmlspecialchars('            <div class="card animated fadeIn" *ngIf="verForma">') . '<br>';
                            echo htmlspecialchars('                <div class="card-header">Grabación / Edicion de ') . $nombreClase . htmlspecialchars('</div>') . '<br>';
                            echo htmlspecialchars('                    div class="card-body">') . '<br>';
                            echo htmlspecialchars('                    <form (ngSubmit)="guardar') . $nombreClase . htmlspecialchars('" #forma="ngForm" novalidation>') . '<br>';
                            echo htmlspecialchars('                        <div class="row">') . '<br>';
                            echo htmlspecialchars('                            <div class="col-sm-6">') . '<br>';
                            echo htmlspecialchars('') . '<br>';
                            echo htmlspecialchars('') . '<br>';
                            echo htmlspecialchars('') . '<br>';
                            echo htmlspecialchars('') . '<br>';
                            echo htmlspecialchars('') . '<br>';
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
