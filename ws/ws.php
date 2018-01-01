<?php

//$html = file_get_contents('http://localhost/hello/ws/pg/home.php');
//$json['return'] = $html;

$q = base64_decode($_GET['q']);
$x=explode('&',$q);
$parametros='';
foreach($x as $i=>$v) {
    $x2=explode('=',$v);
    $p=$x2[0]; //pg
    $vl=$x2[1]; //home
    $_GET[$p]=$vl;
    if ($p!='pg') { //parametros que não vão passar
        if (!isset($first)) {
            $first=true;
            $parametros.='?';
        } else {
            $parametros.='&';
        }
        $parametros.=$p.'='.$vl;
    }
}

//endereço do webservice
$root='http://localhost/hello/ws/';

//página
if (!empty($_GET['pg'])) {
    $html = file_get_contents($root.'pg/'.$_GET['pg'].'.php'.$parametros);
} else {
    $html = file_get_contents($root.'pg/home.php'.$parametros);
}

$json['return']='';
if (!empty($html)) {
    $json['return']=$html;
}
echo json_encode($json);