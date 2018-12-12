<?php

function tienePk($arreglo) {
    $cont = 0;
    foreach ($arreglo as $reg) {
        if ($reg['COLUMN_KEY'] === 'PRI') {
            $cont++;
        }
    }
    if ($cont > 0) {
        return true;
    } else {
        return false;
    }
}

function validaReferencias($conn, $base, $tabla, $nombreClase) {
    $validaciones = "";
    $sql = "SELECT DISTINCT CONSTRAINT_NAME,REFERENCED_TABLE_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE " .
            " WHERE TABLE_SCHEMA = '" . $base . "'" .
            "   AND TABLE_NAME = '" . $tabla . "'" .
            "   AND REFERENCED_TABLE_SCHEMA IS NOT NULL ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $arrFK = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $contFK = 0;
    foreach ($arrFK as $columna) {
        if ($contFK == 0) {
            echo '            $validaciones = array();<br>';
        }
        $contFK++;
        $sql = "SELECT COLUMN_NAME, REFERENCED_TABLE_NAME,REFERENCED_COLUMN_NAME " .
                "  FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE " .
                " WHERE TABLE_SCHEMA = '" . $base . "'" .
                "   AND TABLE_NAME = '" . $tabla . "'" .
                "   AND CONSTRAINT_NAME = '" . $columna['CONSTRAINT_NAME'] . "' " .
                "   AND REFERENCED_TABLE_SCHEMA IS NOT NULL " .
                " ORDER BY ORDINAL_POSITION ";
        $stmt2 = $conn->prepare($sql);
        $stmt2->execute();
        $arrFKCol = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        $contador = 0;
        foreach ($arrFKCol as $campos) {
            if ($contador > 0) {
                echo '            $sql.= "   AND ';
            } else {
                echo '            $sql = "SELECT * FROM ' . $campos['REFERENCED_TABLE_NAME'] . ' ";<br>';
                echo '            $sql.= " WHERE ';
            }
            echo $campos['REFERENCED_COLUMN_NAME'] . ' = \'". $par' . $nombreClase . '->' . $campos['COLUMN_NAME'] . '."\'"; <br>';
            $contador++;
        }
        echo '            if(ejecutaSql3($sql) <> 1){ <br>';
        echo '                array_push($validaciones,"Error en la Referencia de la tabla ' . $campos['REFERENCED_TABLE_NAME'] . '");<br> ';
        echo '            }<br>';
        echo '<br>';
    }
    if ($contFK > 0) {
        echo '            if(count($validaciones) > 0){ <br>';
        echo '                 $respuesta->setStatus(-999);<br>';
        echo '                 $respuesta->setMensaje("Errores de Validación de Datos");<br>';
        echo '                 $respuesta->setDatos("validaciones",$validaciones);<br>';
        echo '                 exit($respuesta->getRespuesta());<br>';
        echo '            }<br>';
        echo '<br>';
    }
}

function tipoDatoAngular($tipoMysql) {
    $tipo = "";
    switch ($tipoMysql) {
        case 'int':
            $tipo = 'number';
            break;
        case 'bigint':
            $tipo = 'number';
            break;
        case 'varchar':
            $tipo = 'string';
            break;
        case 'smallint':
            $tipo = 'number';
            break;
        case 'date':
            $tipo = 'string';
            break;
        case 'decimal':
            $tipo = 'number';
            break;
        case 'time':
            $tipo = 'string';
            break;
        case 'text':
            $tipo = 'string';
            break;
        case 'datetime':
            $tipo = 'string';
            break;
        case 'tinyint':
            $tipo = 'number';
            break;
        case 'longtext':
            $tipo = 'string';
            break;
        case 'blob':
            $tipo = 'any';
            break;
        case 'double':
            $tipo = 'number';
            break;
        case 'enum':
            $tipo = 'any';
            break;
        case 'varbinary':
            $tipo = 'any';
            break;
        case 'char':
            $tipo = 'string';
            break;
        case 'timestamp':
            $tipo = 'string';
            break;
        case 'set':
            $tipo = 'any';
            break;
        case 'longblob':
            $tipo = 'any';
            break;
        case 'mediumtext':
            $tipo = 'any';
            break;
        case 'float':
            $tipo = 'number';
            break;
        case 'mediumint':
            $tipo = 'number';
            break;
        default :
            $tipo = "any";
            break;
    }
    return $tipo;
}

function iniciaDatoAngular($tipoMysql) {
    $tipo = "";
    switch ($tipoMysql) {
        case 'int':
            $tipo = '0';
            break;
        case 'bigint':
            $tipo = '0';
            break;
        case 'varchar':
            $tipo = '""';
            break;
        case 'smallint':
            $tipo = '0';
            break;
        case 'date':
            $tipo = '""';
            break;
        case 'decimal':
            $tipo = '0';
            break;
        case 'time':
            $tipo = '""';
            break;
        case 'text':
            $tipo = '""';
            break;
        case 'datetime':
            $tipo = '""';
            break;
        case 'tinyint':
            $tipo = '0';
            break;
        case 'longtext':
            $tipo = '""';
            break;
        case 'blob':
            $tipo = 'undefined';
            break;
        case 'double':
            $tipo = '0';
            break;
        case 'enum':
            $tipo = 'undefined';
            break;
        case 'varbinary':
            $tipo = 'undefined';
            break;
        case 'char':
            $tipo = '""';
            break;
        case 'timestamp':
            $tipo = '""';
            break;
        case 'set':
            $tipo = 'undefined';
            break;
        case 'longblob':
            $tipo = 'undefined';
            break;
        case 'mediumtext':
            $tipo = 'undefined';
            break;
        case 'float':
            $tipo = '0';
            break;
        case 'mediumint':
            $tipo = '0';
            break;
        default :
            $tipo = "undefined";
            break;
    }
    return $tipo;
}
