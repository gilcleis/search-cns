<?php

namespace Gilclei\SearchCns;

/**
 * Validar CNS
 *
 * PHP version 5.3
 *
 * @category Search
 * @package  search-cns
 * @author   Gilclei Araujo <gilclei@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT Licence
 * @link     https://github.com/gilclei/seach-cns
 */
class FormatData{
    /**
     * Converte o objeto do usuario para array
     *
     * @param stdClass                 $result  dados retornados do
     *
     * @return array
     */
    public static function toArray(\stdClass $result): array
    {
        $user = array();
        
  
        if ( isset($result->Cartoes->CNS))  {
            
            if (isset($result->Cartoes->CNS->numeroCNS)) {
                $user['numeroCNS'] = $result->Cartoes->CNS->numeroCNS;
            }

            if(is_array($result->Cartoes->CNS)){
                foreach ($result->Cartoes->CNS as $cns) {
                    if ($cns->tipoCartao == 'D') {
                        $user['numeroCNS'] = $cns->numeroCNS;
                    }
                }
            }
        }

        if (isset($result->CNS->numeroCNS) && !empty($result->CNS->numeroCNS)) {
            $user['numeroCNS'] = $result->CNS->numeroCNS;
        }
        if (isset($result->NomeCompleto->Nome) && !empty($result->NomeCompleto->Nome)) {
            $user['nome'] = $result->NomeCompleto->Nome;
        }
        if (isset($result->CPF->numeroCPF) && !empty($result->CPF->numeroCPF)) {
            $user['numeroCPF'] = $result->CPF->numeroCPF;
        }
        if(isset($result->Documentos->Identidade->numeroIdentidade)&&!empty($result->Documentos->Identidade->numeroIdentidade))
        {
            $user['tipoDocumento']= 'RG';
            $user['numeroDocumento'] = $result->Documentos->Identidade->numeroIdentidade;
        }
        if (isset($result->NomeSocial) && !empty($result->NomeSocial)) {
            $user['nomeSocial'] = $result->NomeSocial;
        }
        if (isset($result->Mae->Nome) && !empty($result->Mae->Nome)) {
            $user['nomeMae'] = $result->Mae->Nome;
        }
        if (isset($result->Pai->Nome) && !empty($result->Pai->Nome)) {
            $user['nomePai'] = $result->Pai->Nome;
        }
        if (isset($result->Sexo->codigoSexo) && !empty($result->Sexo->codigoSexo)) {
            $user['codigoSexo'] = $result->Sexo->codigoSexo;
        }  
        if (isset($result->dataNascimento) && !empty($result->dataNascimento)) {
            $user['dataNascimento'] = $result->dataNascimento;
        }
        if (isset($result->RacaCor->codigoRacaCor) && !empty($result->RacaCor->codigoRacaCor)) {
            $user['codigoRacaCor'] = $result->RacaCor->codigoRacaCor;
        }                     
        if (isset($result->Documentos->Identidade->numeroIdentidade) && !empty($result->Documentos->Identidade->numeroIdentidade)) {
            $user['numeroIdentidade'] = $result->Documentos->Identidade->numeroIdentidade;
        }        
        if (isset($result->Enderecos->Endereco->TipoLogradouro->codigoTipoLogradouro) && !empty($result->Enderecos->Endereco->TipoLogradouro->codigoTipoLogradouro)) {
            $user['codigoTipoLogradouro'] = $result->Enderecos->Endereco->TipoLogradouro->codigoTipoLogradouro;
        }        
        if (isset($result->Enderecos->Endereco->TipoLogradouro->descricaoTipoLogradouro) && !empty($result->Enderecos->Endereco->TipoLogradouro->descricaoTipoLogradouro)) {
            $user['descricaoTipoLogradouro'] = $result->Enderecos->Endereco->TipoLogradouro->descricaoTipoLogradouro;
        }
        if (isset($result->Enderecos->Endereco->nomeLogradouro) && !empty($result->Enderecos->Endereco->nomeLogradouro)) {
            $user['nomeLogradouro'] = $result->Enderecos->Endereco->nomeLogradouro;
        }
        if (isset($result->Enderecos->Endereco->numero) && !empty($result->Enderecos->Endereco->numero)) {
            $user['numeroEndereco'] = $result->Enderecos->Endereco->numero;
        }
        if (isset($result->Enderecos->Endereco->complemento) && !empty($result->Enderecos->Endereco->complemento)) {
            $user['complementoEndereco'] = $result->Enderecos->Endereco->complemento;
        }        
        if (isset($result->Enderecos->Endereco->Bairro->descricaoBairro) && !empty($result->Enderecos->Endereco->Bairro->descricaoBairro)) {
            $user['descricaoBairro'] = $result->Enderecos->Endereco->Bairro->descricaoBairro;
        }
        if (isset($result->Enderecos->Endereco->CEP->numeroCEP) && !empty($result->Enderecos->Endereco->CEP->numeroCEP)) {
            $user['numeroCEP'] = $result->Enderecos->Endereco->CEP->numeroCEP;            
        }
        if (isset($result->Enderecos->Endereco->Municipio->codigoMunicipio) && !empty($result->Enderecos->Endereco->Municipio->codigoMunicipio)) {
            $user['codigoMunicipioEndereco'] = $result->Enderecos->Endereco->Municipio->codigoMunicipio;
        }
        if (isset($result->Enderecos->Endereco->Municipio->nomeMunicipio) && !empty($result->Enderecos->Endereco->Municipio->nomeMunicipio)) {
            $user['nomeMunicipioEndereco'] = $result->Enderecos->Endereco->Municipio->nomeMunicipio;
        }
        if (isset($result->Enderecos->Endereco->Municipio->UF->siglaUF) && !empty($result->Enderecos->Endereco->Municipio->UF->siglaUF)) {
            $user['siglaUFEndereco'] = $result->Enderecos->Endereco->Municipio->UF->siglaUF;
        }
        if (isset($result->Telefones->Telefone->DDD) && !empty($result->Telefones->Telefone->DDD)) {
            $user['ddd'] = $result->Telefones->Telefone->DDD;
        }
        if (isset($result->Telefones->Telefone->numeroTelefone) && !empty($result->Telefones->Telefone->numeroTelefone)) {
            $user['numeroTelefone'] = $result->Telefones->Telefone->numeroTelefone;
        }
        if (isset($result->Emails->Email)) {
            if (isset($result->Emails->Email->descricaoEmail)) {
                $user['descricaoEmail'] = $result->Emails->Email->descricaoEmail;
            }

            if (is_array($result->Emails->Email)) {
                foreach ($result->Emails->Email as $email) {
                    if ($email->tipoEmail == 'P') {
                        $user['descricaoEmail'] = $email->descricaoEmail;
                    }
                }
            }
        }        
        if (isset($result->DadosNacionalidade->PaisNascimento->codigoPais) && !empty($result->DadosNacionalidade->PaisNascimento->codigoPais)) {
            $user['codigoPaisNascimento'] = $result->DadosNacionalidade->PaisNascimento->codigoPais;
        }
        if (isset($result->MunicipioNascimento->codigoMunicipio) && !empty($result->MunicipioNascimento->codigoMunicipio)) {
            $user['codigoMunicipioNascimneto'] = $result->MunicipioNascimento->codigoMunicipio;
        }
        if (isset($result->MunicipioNascimento->nomeMunicipio) && !empty($result->MunicipioNascimento->nomeMunicipio)) {
            $user['nomeMunicipioNascimneto'] = $result->MunicipioNascimento->nomeMunicipio;
        }
      
        if (isset($result->MunicipioNascimento->UF->siglaUF) && !empty($result->MunicipioNascimento->UF->siglaUF)) {
            $user['siglaUFNascimento'] = $result->MunicipioNascimento->UF->siglaUF;
        }
        return $user;
    }
}