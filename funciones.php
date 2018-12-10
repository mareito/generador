<?php

function tienePk($arreglo) {
    $cont = 0;
    foreach ($arreglo as $reg) {
        if($reg['COLUMN_KEY'] === 'PRI'){
            $cont++;
        }
    }
    if($cont > 0){
        return true;
    }else{
        return false;
    }
}
