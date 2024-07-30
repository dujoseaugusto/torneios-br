<?php
include("seguranca/seguranca.php");
    //protegePagina(2);
    require_once('php/class.php');
    require_once('bd_funcao/maysql.php');
    require_once('php/funcao_0.2.php');

/*
 * ***********************************************************************
 Copyright [2011] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 * ***********************************************************************
 */

require_once "PagSeguroLibrary/PagSeguroLibrary.php";

/***
 * Provides for user a option to configure their credentials without changes in PagSeguroConfigWrapper.php file.
 */ 
class PagSeguroConfigWrapper
{
    public static function getConfig()
    {
        $PagSeguroConfig = array();

        $PagSeguroConfig['environment'] = "production"; // production, sandbox

        $PagSeguroConfig['credentials'] = array();
        $PagSeguroConfig['credentials']['email'] = "wolgran-celani@hotmail.com";
        $PagSeguroConfig['credentials']['token']['production'] = "7440F9AF5284498DAC436A87D4D62AEF";
        $PagSeguroConfig['credentials']['token']['sandbox'] = "0EB8A85392B54612BB335BF6BEFD6258";
        $PagSeguroConfig['credentials']['appId']['production'] = "your__production_pagseguro_application_id";
        $PagSeguroConfig['credentials']['appId']['sandbox'] = "app4599474809";
        $PagSeguroConfig['credentials']['appKey']['production'] = "your_production_application_key";
        $PagSeguroConfig['credentials']['appKey']['sandbox'] = "A73EAE4E8C8C136994894FBBFDE8F649";

        $PagSeguroConfig['application'] = array();
        $PagSeguroConfig['application']['charset'] = "UTF-8"; // UTF-8, ISO-8859-1

        $PagSeguroConfig['log'] = array();
        $PagSeguroConfig['log']['active'] = false;
        // Informe o path completo (relativo ao path da lib) para o arquivo, ex.: ../PagSeguroLibrary/logs.txt
        $PagSeguroConfig['log']['fileLocation'] = "log.txt";

        return $PagSeguroConfig;
    }
}

/**
 * Class with a main method to illustrate the usage of the domain class PagSeguroPaymentRequest
 */
class CreatePaymentRequest
{

    public static function main()
    {
        if($idetapa_passaro = (isset($_GET['kj'])) ? dcript($_GET['kj'],'Erro no recebimento do id') : NULL){
            $consulta = new consulta();
                    $consulta->campo    = 'a.id, b.nome, c.nome, d.nome, c.data_etapa, c.local, b.anilha, b.id_modalidade, c.id_temporada, d.id_clube, a.numero, d.email, d.cpf, e.valor AS valor_incricao';
                    $consulta->tabela   = "arpag_passaro_etapa AS a INNER JOIN arpag_passaro    AS b ON b.id = a.id_passaro
                                                                    INNER JOIN arpag_etapa      AS c ON c.id = a.id_etapa
                                                                    INNER JOIN arpag_pessoa     AS d ON d.id = a.id_pessoa
                                                                    INNER JOIN arpag_valor_inscricao_etapa AS e ON  (e.id_etapa = c.id) AND (e.id_modalidade = b.id_modalidade)";
                    $consulta->parametro= "a.id = ".$idetapa_passaro;
                    $executa = select_db($consulta);
                    $linha = $executa->fetch_array();
            
            // Instantiate a new payment request
            $paymentRequest = new PagSeguroPaymentRequest();

            // Set the currency
            $paymentRequest->setCurrency("BRL");

            // Add an item for this payment request
            $paymentRequest->addItem($linha['id'],$linha[2]." - ".$linha[1], 1, $linha['valor_incricao']);

            // Set a reference code for this payment request. It is useful to identify this payment
            // in future notifications.
            $paymentRequest->setReference(cript(date('Y').$linha['id']));

            // Set shipping information for this payment request
            $sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');
            $paymentRequest->setShippingType($sedexCode);
            $paymentRequest->setShippingAddress(
                '37800000',
                'Avenida dos Inconfidentes',
                '177',
                'B',
                'Centro',
                'Guaxupé',
                'MG',
                'BRA'
            );

            // Set your customer information.
            $paymentRequest->setSender(
                $linha[3],
                'xxxxxxx@sandbox.pagseguro.com.br',
                '35',
                '999792040',
                'CPF',
                $linha['cpf']
            );

            // Set the url used by PagSeguro to redirect user after checkout process ends
            $paymentRequest->setRedirectUrl("http://arpag.com.br/arpag_test/finalizapagamento.php?i=".cript($linha['id'])."@".cript(date('Y').$linha['id']));

            // Add checkout metadata information
            $paymentRequest->addMetadata('PASSENGER_CPF', $linha['cpf'], 1);
            $paymentRequest->addMetadata('GAME_NAME', 'DOTA');

            // Another way to set checkout parameters
           /// $paymentRequest->addParameter('notificationURL', 'http://www.lojamodelo.com.br/nas');
            $paymentRequest->addParameter('senderBornDate', '07/05/1981');

            try {

                /*
                 * #### Credentials #####
                 * Replace the parameters below with your credentials
                 * You can also get your credentials from a config file. See an example:
                 * $credentials = new PagSeguroAccountCredentials("vendedor@lojamodelo.com.br",
                 * "E231B2C9BCC8474DA2E260B6C8CF60D3");
                 */

                // seller authentication
                $credentials = PagSeguroConfig::getAccountCredentials();

                // application authentication
                //$credentials = PagSeguroConfig::getApplicationCredentials();

                //$credentials->setAuthorizationCode("E231B2C9BCC8474DA2E260B6C8CF60D3");

                // Register this payment request in PagSeguro to obtain the payment URL to redirect your customer.
                $url = $paymentRequest->register($credentials);

                self::printPaymentUrl($url);

            } catch (PagSeguroServiceException $e) {
                die($e->getMessage());
            }
        }
    }

    public static function printPaymentUrl($url)
    {
        if ($url) {
            header("location: ".$url);
        }
    }
}

CreatePaymentRequest::main();
