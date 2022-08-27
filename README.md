[![Latest Stable Version](http://poser.pugx.org/gilclei/search-cns/v)](https://packagist.org/packages/gilclei/search-cns) [![Total Downloads](http://poser.pugx.org/gilclei/search-cns/downloads)](https://packagist.org/packages/gilclei/search-cns) [![Latest Unstable Version](http://poser.pugx.org/gilclei/search-cns/v/unstable)](https://packagist.org/packages/gilclei/search-cns) [![License](http://poser.pugx.org/gilclei/search-cns/license)](https://packagist.org/packages/gilclei/search-cns) [![Size](https://img.shields.io/github/repo-size/gilcleis/search-cns)]() [![Size](https://img.shields.io/github/stars/gilcleis/search-cns)]()

Search-CNS
=======
Projeto de uma biblioteca para consultar dos dados do usuário SUS na base de dados do Datasus

## Necessário
[![PHP Version Require](http://poser.pugx.org/gilclei/search-cns/require/php)](https://packagist.org/packages/gilclei/search-cns)

## Referência

[Interoperabilidade &#8211; catálogo de serviços &#8211; DATASUS](https://datasus.saude.gov.br/interoperabilidade-catalogo-de-servicos/).

Instalação
------------

Use o composer para gerenciar suas dependências e baixar search-cns:

```bash
composer require gilclei/search-cns
```

Example
-------
```php
<?php

//require_once "vendor/autoload.php";

use Gilclei\SearchCns\CNS;
//dados de homologação disponiilizado pelo datasus
//https://datasus.saude.gov.br/interoperabilidade-catalogo-de-servicos

$cpf = '66105234368';
$userName = 'CADSUS.CNS.PDQ.PUBLICO';
$password = 'kUXNmiiii#RDdlOELdoe00966';
$cnes = '6963447';
$usuario = 'LEONARDO';
$service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
$cns = '703404696479515';

$consulta = CNS::searchByCpf($cpf, $userName, $password, $cnes, $usuario, $service);
echo json_encode($consulta,JSON_PRETTY_PRINT);

/*SearchByCpf
{
    "numeroCNS": "703404696479515",
    "nome": "SERGIO ARAUJO CORREIA LIMA",
    "dataNascimento": "1981-11-10",
    "nomeMae": "LINDYNALVA SOARES ARAUJO CORREIA LIMA",
    "nomePai": "SEM INFORMA\u00c7\u00c3O",
    "codigoSexo": "F",
    "codigoMunicipioNascimento": "211130",
    "nomeMunicipioNascimento": "SAO LUIS",
    "siglaUfMunicipioNascimento": "MA",
    "codigoPaisNascimento": "010",
    "nomePaisNascimento": "BRASIL"
}
*/


?>

```
```
php exemple.php
```
```
vendor/bin/phpunit tests/
```
