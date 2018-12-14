<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Componente de Angular</h5>               
                <p class="card-text">Componente en typescript para la clase de angular</p>
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
                            echo 'import { Component, OnInit } from \'@angular/core\';<br>';
                            echo 'import { ' . $nombreClase . ' } from \'../../modelo/modelo\';<br>';
                            echo 'import { ' . $nombreClase . 'Service } from \'../../services/' . $_SESSION['tabla'] . '.service\';<br>';
                            echo 'import \'rxjs/Rx\';<br>';
                            echo 'import {LocalStrgService} from \'../../services/local-strg.service\';<br>';
                            echo 'import {Router} from \'@angular/router\';<br>';
                            echo '<br>';
                            echo '<br>';
                            echo '@Component({<br>';
                            echo '    selector: \'app-' . $_SESSION['tabla'] . '\',<br>';
                            echo '    templateUrl: \'./' . $_SESSION['tabla'] . '.component.html\'<br>';
                            echo '})<br>';
                            echo '<br>';
                            echo '<br>';
                            echo 'export class ' . $nombreClase . 'Component implements OnInit {<br>';
                            echo '<br>';
                            echo '    public arr' . $nombreClase . ':' . $nombreClase . '[] = [];<br>';
                            echo '    public verForma:boolean = false;<br>';
                            echo '    public ' . $_SESSION['tabla'] . ':' . $nombreClase . ' = new ' . $nombreClase . '();<br>';
                            echo '    public cargando:boolean = false;<br>';
                            echo '    public mensaje:string = "";<br>';
                            echo '<br>';
                            echo '    constructor(private _' . $_SESSION['tabla'] . 'Service:' . $nombreClase . 'Service,<br>';
                            echo '                private router:Router,<br>';
                            echo '                private _locStrg:LocalStrgService) {<br>';
                            echo '        if(!this._locStrg.tokenValido("' . $_SESSION['tabla'] . '")){<br>';
                            echo '            this.router.navigate([\'/login\']);<br>';
                            echo '        }else{<br>';
                            echo '            this.consultar' . $nombreClase . '();<br>';
                            echo '            this.iniciarCampos();<br>';
                            echo '        }<br>';
                            echo '    }<br>';
                            echo '<br>';
                            echo '    iniciarCampos(){<br>';
                            foreach ($arrCols as $columnas) {
                                echo '        this.' . $columnas['COLUMN_NAME'] . ' = ' . iniciaDatoAngular($columnas['DATA_TYPE']);
                                echo ';<br>';
                            }
                            echo '    }<br>';
                            echo '<br>';
                            echo '    consultar' . $nombreClase . '(){<br>';
                            echo '        this.cargando = true;<br>';
                            echo '        this.arr' . $nombreClase . ' = [];<br>';
                            echo '        this._' . $_SESSION['tabla'] . 'Service.getArr' . $nombreClase . '(this._locStrg.getToken()).subscribe(<br>';
                            echo '                (resp)=>{<br>';
                            echo '                         this.observaciones = resp;   <br>';
                            echo '                 },<br>';
                            echo '                 {(error)=>{console.log(error)});<br>';
                            echo '    }<br>';
                            echo '<br>';
                            echo '    ngOnInit() {}<br>';
                            echo '<br>';
                            echo '    guardarObservacion(){<br>';
                            echo '        let guardar = true;<br>';
                            echo '        this._' . $_SESSION['tabla'] . 'Service.guardar' . $nombreClase . '(this.' . $_SESSION['tabla'] . ').subscribe(<br>';
                            echo '            (resp) =>{<br>';
                            echo '                this.mensaje=resp[\'mensaje\'];<br>';
                            echo '                for(let obj of this.arr' . $nombreClase . '){<br>';
                            echo '                    if (';
                            $cont = 0;
                            foreach ($arrCols as $col) {
                                if ($col['COLUMN_KEY'] === 'PRI') {
                                    if ($cont > 0) {
                                        echo '<br>                        && ';
                                    }
                                    echo 'obj.' . $col['COLUMN_NAME'] . ' == this.' . $_SESSION['tabla'] . '.' . $col['COLUMN_NAME'] . ' ';
                                    $cont++;
                                }
                            }
                            echo '){<br>';
                            foreach ($arrCols as $col) {
                                echo '                        obj.' . $col['COLUMN_NAME'] . ' = this.' . $_SESSION['tabla'] . '.' . $col['COLUMN_NAME'] . ';<br>';
                            }
                            echo '                        guardar = false;<br>';
                            echo '                    }<br>';
                            echo '                    if(guardar){<br>';
                            echo '                        let new' . $nombreClase . ' = new ' . $nombreClase . '();<br>';
                            foreach ($arrCols as $col) {
                                echo '                        new' . $nombreClase . '.' . $col['COLUMN_NAME'] . ' = ';
                                if (tipoDatoAngular($col['DATA_TYPE']) == 'number') {
                                    echo 'parseInt(this.' . $_SESSION['tabla'] . '.' . $col['COLUMN_NAME'] . ');<br>';
                                } else {
                                    echo 'this.' . $_SESSION['tabla'] . '.' . $col['COLUMN_NAME'] . ';<br>';
                                }
                            }
                            echo '                    }<br>';
                            echo '                    this.ocultarForma();<br>';
                            echo '                },<br>';
                            echo '                (error) =>{<br>';
                            echo '                    console.error(error);<br>';
                            echo '                }<br>';
                            echo '            );<br>';
                            echo '        }<br>';
                            echo '<br>';                            
                            echo '    editar' . $nombreClase . '(' . $_SESSION['tabla'] . ':' . $nombreClase . '){<br>';                            
                            foreach ($arrCols as $col) {
                                echo '        this.' . $_SESSION['tabla'] . '.' . $col['COLUMN_NAME'] . ' = ' . $_SESSION['tabla'] . '.' . $col['COLUMN_NAME'] . ';<br>';
                            }
                            echo '        this.verForma = true;<br>';
                            echo '    }<br>';
                            
                            echo '<br>';
                            echo '    ocultarForma(){<br>';
                            echo '        this.verForma= false;<br>';
                            echo '        this.mensaje = "";<br>';
                            echo '    }<br>';
                            echo '<br>';
                            echo '    mostrarForma(){<br>';
                            echo '        this.verForma = true;<br>';
                            echo '        this.mensaje = "";<br>';
                            echo '        this.iniciarCampos();<br>';
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

