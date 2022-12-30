<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

date_default_timezone_set("America/Sao_Paulo");

$GLOBALS['secretJWT'] = '123456';

include_once "classes/autoload.php";
new Autoload();

$rota = new Rotas();
$rota->add('POST','/usuarios/login','Usuarios::login', false);
$rota->add('GET', '/clientes/lista', 'Clientes::listarTodos', true);
$rota->add('GET', '/clientes/lista/[PARAMETRO]', 'Clientes::listarUnico', true);
$rota->add('PUT', '/clientes/atualizar/[PARAMETRO]', 'Clientes::atualizar', true);
$rota->add('DELETE', '/clientes/deletar/[PARAMETRO]', 'Clientes::deletar', true);

$rota->ir($_GET['path']);