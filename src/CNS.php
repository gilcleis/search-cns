<?php

namespace Gilclei\SearchCns;

use Exception;
use Gilclei\CheckCns\CheckCNS;
use Gilclei\CheckCpf\CheckCPF;
use Gilclei\SearchCns\Exceptions\CnsInvalidException;
use Gilclei\SearchCns\Exceptions\CpfInvalidException;
use Gilclei\SearchCns\Exceptions\WsAccessExeption;
use Gilclei\SearchCns\WsseAuthHeader;


/**
 * Impementação da consulta do cartao sus, baseado nas especificacoes:
 * https://datasus.saude.gov.br/catalogo-de-servicos/
 *
 *
 * @category Search
 * @package  search-cns
 * @author   Gilclei Araujo <gilclei@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT Licence
 * @link     https://github.com/gilclei/seach-cns
 */
class CNS
{

    /**
     * Busca os dados apartir do CPF
     *
     * @param string                 $cpf                 numero do cpf do usuario
     * @param string                 $userName            username
     * @param string                 $password            password
     * @param string                 $cnes                cnes da unidade
     * @param string                 $usuario             usuario da unidade
     * @param string                 $service             service (producao ou homologacao)
     *
     * @return array Dados do usuario como um objeto PHP
     */
    public static function searchByCpf(string $cpf, string $userName, string $password, string $cnes, string $usuario, string $service): array
    {
        if (!CheckCPF::isValid($cpf)) {
            throw new CpfInvalidException("invalid cpf: {$cpf}");
        }
        $wsse_header = new WsseAuthHeader($userName, $password);

        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $context = stream_context_create($opts);

        $options = array(
            'trace' => 1,
            'stream_context' => $context,
        );
        try {
            $client = new \SoapClient($service, $options);
            $client->__setSoapHeaders(array($wsse_header));
            $dataSus = new \stdClass();
            $dataSus->CNESUsuario = new \stdClass();
            $dataSus->CNESUsuario->CNES = $cnes;
            $dataSus->CNESUsuario->Usuario = $usuario;

            $dataSus->FiltroPesquisa = new \stdClass();
            $dataSus->FiltroPesquisa->CPF = new \stdClass();
            $dataSus->FiltroPesquisa->CPF->numeroCPF = $cpf;
            $dataSus->FiltroPesquisa->tipoPesquisa = 'IDENTICA';
            $dataSus->higienizar = '0';
            $result = $client->pesquisar($dataSus);
            return FormatData::toArray($result->ResultadoPesquisa);
        } catch (\Exception $e) {                        
            throw new WsAccessExeption("webservice error: {$e->getMessage()}");
        }
    }    

     /**
     * Busca os dados apartir do CNS
     *
     * @param string                 $cns                 numero do cartao sus do usuario
     * @param string                 $userName            username
     * @param string                 $password            password
     * @param string                 $cnes                cnes da unidade
     * @param string                 $usuario             usuario da unidade
     * @param string                 $service             service (producao ou homologacao)
     *
     * @return stdClass Dados do usuario como um objeto PHP
     */
    public static function searchByCns(string $cns, string $userName, string $password, string $cnes, string $usuario, string $service)
    {
        if (!CheckCNS::isValid($cns)) {
            throw new CnsInvalidException("invalid cns: {$cns}");
        }
        $wsse_header = new WsseAuthHeader($userName, $password);

        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $context = stream_context_create($opts);

        $options = array(
            'trace' => 1,
            'stream_context' => $context,
        );
        try {
            $client = new \SoapClient($service, $options);
            $client->__setSoapHeaders(array($wsse_header));
            $dataSus = new \stdClass();
            $dataSus->CNESUsuario = new \stdClass();
            $dataSus->CNESUsuario->CNES = $cnes;
            $dataSus->CNESUsuario->Usuario = $usuario;
            $dataSus->CNS = new \stdClass();
            $dataSus->CNS->numeroCNS = $cns;
            $method = 'consultar';
            $result = $client->__soapCall($method, array($dataSus));            
            return FormatData::toArray($result->UsuarioSUS);            
        } catch (\Exception $e) {            
            throw new WsAccessExeption("webservice error: {$e->getMessage()}");
        }
    }


     /**
     * Busca os dados apartir do nome,dada de nascimento e nome da mãe
     *
     * @param string                 $cns                 numero do cartao sus do usuario
     * @param string                 $nomeMae             nome da mãe do usuario
     * @param string                 $dataNascimento      data de nascimento do usuario
     * @param string                 $userName            username
     * @param string                 $password            password
     * @param string                 $cnes                cnes da unidade
     * @param string                 $usuario             usuario da unidade
     * @param string                 $service             service (producao ou homologacao)
     *
     * @return stdClass Dados do usuario como um objeto PHP
     */
    public static function searchByName(string $nome,string $nomeMae,string $dataNascimento, string $userName, string $password, string $cnes, string $usuario, string $service)
    {
        // if (!CheckCNS::isValid($cns)) {
        //     throw new CnsInvalidException("invalid cns: {$cns}");
        // }
        $wsse_header = new WsseAuthHeader($userName, $password);

        $opts = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $context = stream_context_create($opts);

        $options = array(
            'trace' => 1,
            'stream_context' => $context,
        );
        try {
            $client = new \SoapClient($service, $options);
            $client->__setSoapHeaders(array($wsse_header));
            $dataSus = new \stdClass();
            $dataSus->CNESUsuario = new \stdClass();
            $dataSus->CNESUsuario->CNES = $cnes;
            $dataSus->CNESUsuario->Usuario = $usuario;
            $dataSus->FiltroPesquisa = new \stdClass();
            $dataSus->FiltroPesquisa->nomeCompleto = new \stdClass();
            $dataSus->FiltroPesquisa->nomeCompleto->Nome = $nome;
            $dataSus->FiltroPesquisa->dataNascimento = new \stdClass();
            $dataSus->FiltroPesquisa->dataNascimento = $dataNascimento;
            $dataSus->FiltroPesquisa->Mae = new \stdClass();
            $dataSus->FiltroPesquisa->Mae->Nome = $nomeMae;
            $dataSus->FiltroPesquisa->tipoPesquisa = 'APROXIMADA';
            $dataSus->higienizar = '0';
            $result = $client->pesquisar($dataSus);            
            return FormatData::toArray($result->ResultadoPesquisa); 
         
        } catch (\Exception $e) {            
            throw new WsAccessExeption("webservice error: {$e->getMessage()}");
        }
    }
}
