<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

if(isset($_GET['path'])){
    $path = explode("/",$_GET['path']);
}
else{
    echo "Caminho não existe 1";
    exit;
}
if(isset($path[0])){ $api = $path[0];}else{ echo "Caminho não existe 2"; exit; }
if(isset($path[1])){ $acao = $path[1];}else{ $acao = ''; }
if(isset($path[2])){ $parametro = $path[2];}else{ $parametro = ''; }

$method = $_SERVER['REQUEST_METHOD'];

$GLOBALS['secretJWT'] = '123456';

include_once "classes/autoload.php";
new Autoload();

