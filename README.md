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

?>

```
```
php exemple.php
```
```
vendor/bin/phpunit tests/
```

<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

## [0.9.4](https://github.com/gilcleis/search-cns/compare/0.9.3...0.9.4) (2022-09-08)

### Features
* Correção do FormatData, ajuste do numeroCNS ([b8e2337](https://github.com/gilcleis/search-cns/commit/b8e233746d35171bca28f862303fce7a726863a1))
---
## [0.9.3](https://github.com/gilcleis/search-cns/compare/0.9.2...0.9.3) (2022-09-03)

### Features
* ativado a checagem de tipo (strict_types) ([4369b7a](https://github.com/gilcleis/search-cns/commit/4369b7a8954e81879912512f76f943751958e1bd))
---
## [0.9.2](https://github.com/gilcleis/search-cns/compare/0.9.1...0.9.2) (2022-08-30)

### Features
* fixit get email in FormatData ([aa07863]((https://github.com/gilcleis/search-cns/commit/aa07863376d5ea9c63bbf1cf45c661b63851ad88)))
---
## [0.9.1](https://github.com/gilcleis/search-cns/compare/0.9.0...0.9.2) (2022-08-27)

### Features
* add more examples ([9231368]((https://github.com/gilcleis/search-cns/commit/231368de4b38820f150b092d694d505e7bcab54)))
---
## [0.9.0]() (2022-08-27)

### Features
* Initial commit ([36a4852]((https://github.com/gilcleis/search-cns/commit/36a4852c1012dd1583075268b275607eb13ffadb)))
---

