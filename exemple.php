<?php

require_once "vendor/autoload.php";

use Gilclei\SearchCns\CNS;


$userName = 'CADSUS.CNS.PDQ.PUBLICO';
$password = 'kUXNmiiii#RDdlOELdoe00966';
$cnes = '6963447';
$usuario = 'LEONARDO';
$service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';


$cpf = '66105234368';
try{
    $consulta = CNS::searchByCpf($cpf, $userName, $password, $cnes, $usuario, $service);
    echo json_encode($consulta, JSON_PRETTY_PRINT);
}catch (\Exception $e){
    echo $e->getMessage();
}

$cns = '703404696479515';
try{
    $consulta = CNS::searchByCns($cns, $userName, $password, $cnes, $usuario, $service);
    echo json_encode($consulta, JSON_PRETTY_PRINT);
}catch (\Exception $e){
    echo $e->getMessage();
}

$nome = "SERGIO ARAUJO CORREIA LIMA";
$dataNascimento =  "1981-11-10";
$nomeMae = "LINDYNALVA SOARES ARAUJO CORREIA LIMA";
try{
    $consulta = CNS::searchByName($nome, $nomeMae, $dataNascimento, $userName, $password, $cnes, $usuario, $service);
    echo json_encode($consulta, JSON_PRETTY_PRINT);
}catch (\Exception $e){
    echo $e->getMessage();
}

