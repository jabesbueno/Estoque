<?php
function get_alert_code($msg, $status) {
    if ($msg == '' || is_null($msg)) {
        return '';
    }
    $lista_status = array('success', 'info', 'warning', 'danger');
    if (!in_array($status, $lista_status)) {
        return '';
    }
    return '<div class="alert alert-' . $status . '" role="alert">' . $msg . '</div>';
}
function get_src_foto_candidato($img) {
    $dir_fotos = "assets/fotos/";
    if (is_null($img) || !file_exists($dir_fotos . $img)) {
        return base_url("assets/img/semImg.png");
    }
    return base_url($dir_fotos . $img);
}
function display_erros($erro) {
    if (is_null($erro)) {
        return '';
    }
    if (!is_array($erro)) {
        return '<span style="font-size: 10px; color: red; font-style: italic;">' . $erro . '</span>';
    } else {
        $todos_erros = '';
        foreach ($erro as $err) {
            $todos_erros .= '<span style="font-size: 10px; color: red; font-style: italic;">' . $err . '</span><br />';
        }
        return $todos_erros;
    }
    return '';
}
function converte_data($data) {
    if (strstr($data, "/")) {//verifica se tem a barra /
        $d = explode("/", $data); //tira a barra
        $rstData = "$d[2]-$d[1]-$d[0]"; //separa as datas $d[2] = ano $d[1] = mes etc...
        return $rstData;
    } else if (strstr($data, "-")) {
        $data = substr($data, 0, 10);
        $d = explode("-", $data);
        $rstData = "$d[2]/$d[1]/$d[0]";
        return $rstData;
    } else {
        return '';
    }
}
function validar_mes($data) {
    if (strstr($data, "/")) {
        $d = explode("/", $data); 
        $rstData = "$d[1]-$d[0]"; 
        if($d[0]>12 || $d[0]<1 && $d[1]<date("Y"))
        {
           return '';
        }
        return $rstData;
    } else if (strstr($data, "-")) {
        $data = substr($data, 0, 7);
        $d = explode("-", $data);
        $rstData = "$d[1]/$d[0]";
        if($d[0]>12 || $d[0]<1 && $d[1]<date("Y"))
        {
           return '';
        }
        return $rstData;
    
}
}

function validar_data($data1, $data2 = null) 
{
    if($data2 != null) 
    {
        if($data1 <= date("Y-m-d") && $data1 >= $data2) return true;
    }
    else 
    {
        if($data1 <= date("Y-m-d")) return true;
    }   

    return false;  
}