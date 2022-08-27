<?php

use Gilclei\CheckCns\CheckCNS;
use Gilclei\CheckCpf\CheckCPF;

use Gilclei\SearchCns\CNS;
use Gilclei\SearchCns\Exceptions\CnsInvalidException;
use Gilclei\SearchCns\Exceptions\CpfInvalidException;
use Gilclei\SearchCns\Exceptions\WsAccessExeption;
use Gilclei\SearchCns\WsseAuthHeader;
use PHPUnit\Framework\TestCase;

class CnsTest extends TestCase
{

    public function testWsseAuthHeader(){
        $userName = 'CADSUS.CNS.PDQ.PUBLICO';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $wsse_header = new WsseAuthHeader($userName, $password,$service);
        
        $this->assertEquals($service,$wsse_header->namespace);

    }

    public function testSearchByCpf()
    {

        $expected = [
            "numeroCNS" => "703404696479515",
            "nome" => "SERGIO ARAUJO CORREIA LIMA",
            "nomeMae" => "LINDYNALVA SOARES ARAUJO CORREIA LIMA",
            "nomePai" => "SEM INFORMAÇÃO",
            "codigoSexo" => "F",
            "dataNascimento" => "1981-11-10",
            "codigoMunicipioNascimneto" => "211130",
            "nomeMunicipioNascimneto" => "SAO LUIS",
            "siglaUFNascimento" => "MA"
        ];

        $userName = 'CADSUS.CNS.PDQ.PUBLICO';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $cnes = '6963447';
        $usuario = 'LEONARDO';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $cns = '703404696479515';
        $cpf = '66105234368';

        $consulta = CNS::searchByCpf($cpf, $userName, $password, $cnes, $usuario, $service);
        $this->assertEquals($expected, $consulta);
    }


    public function testSearchByCpfInvalid()
    {
        $userName = 'CADSUS.CNS.PDQ.PUBLICO';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $cnes = '6963447';
        $usuario = 'LEONARDO';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $cns = '703404696479515';
        $cpf = '661052343688';

        $this->expectException(CpfInvalidException::class);
        $this->expectExceptionMessage("invalid cpf: {$cpf}");
        $this->expectExceptionCode(99);

        $consulta = CNS::searchByCpf($cpf, $userName, $password, $cnes, $usuario, $service);        
    }

    public function testSearchByCpfAccessErro()
    {
        $userName = 'CADSUS.CNS.PDQ.PUBLICO1';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $cnes = '6963447';
        $usuario = 'LEONARDO';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $cns = '703404696479515';
        $cpf = '66105234368';

        $this->expectException(WsAccessExeption::class);
        $this->expectExceptionMessage("webservice error: Uma ou mais regras negociais foram violadas, verifique a lista de erros");
        $this->expectExceptionCode(97);
        $consulta = CNS::searchByCpf($cpf, $userName, $password, $cnes, $usuario, $service);        
    }

    public function testSearchByCns()
    {

        $expected = [
            "numeroCNS" => "703404696479515",
            "nome" => "SERGIO ARAUJO CORREIA LIMA",
            "dataNascimento" => "1981-11-10",
            "nomeMae" => "LINDYNALVA SOARES ARAUJO CORREIA LIMA",
            "nomePai" => "SEM INFORMAÇÃO",
            "codigoSexo" => "F",
            "codigoMunicipioNascimento" => "211130",
            "nomeMunicipioNascimento" => "SAO LUIS",
            "siglaUfMunicipioNascimento" => "MA",
            "codigoPaisNascimento" => "010",
            "nomePaisNascimento" => "BRASIL"
        ];

        $userName = 'CADSUS.CNS.PDQ.PUBLICO';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $cnes = '6963447';
        $usuario = 'LEONARDO';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $cns = '703404696479515';
        $cpf = '66105234368';

        $consulta = CNS::searchByCns($cns, $userName, $password, $cnes, $usuario, $service);
        $this->assertEquals("SERGIO ARAUJO CORREIA LIMA", $consulta["nome"]);
    }

    public function testSearchByCnsAccessErro()
    {
        $userName = 'CADSUS.CNS.PDQ.PUBLICO1';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $cnes = '6963447';
        $usuario = 'LEONARDO';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $cns = '703404696479515';
        $cpf = '661052343688';

        $this->expectException(WsAccessExeption::class);
        $this->expectExceptionMessage("webservice error: ");
        $this->expectExceptionCode(97);
        $consulta = CNS::searchByCns($cns, $userName, $password, $cnes, $usuario, $service);        
    }

    public function testSearchByCnsInvalid()
    {
        $userName = 'CADSUS.CNS.PDQ.PUBLICO';
        $password = 'kUXNmiiii#RDdlOELdoe00966';
        $cnes = '6963447';
        $usuario = 'LEONARDO';
        $service = 'https://servicoshm.saude.gov.br/cadsus/CadsusService/v5r0?wsdl';
        $cns = '7034046964795155';
        $cpf = '661052343688';

        $this->expectException(CnsInvalidException::class);
        $this->expectExceptionMessage("invalid cns: {$cns}");
        $this->expectExceptionCode(98);

        $consulta = CNS::searchByCns($cns, $userName, $password, $cnes, $usuario, $service);        
    }
   
   

}
