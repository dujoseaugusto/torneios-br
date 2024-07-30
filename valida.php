<?php
include("seguranca/seguranca.php");
require_once("php/class.php");
require_once("bd_funcao/maysql.php");
require_once('php/funcao_0.2.php');

// Verifica se um formul�rio foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Salva duas vari�veis com o que foi digitado no formul�rio
// Detalhe: faz uma verifica��o com isset() pra saber se o campo foi preenchido
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';

$senha = sha1($senha);
// Utiliza uma fun��o criada no seguranca.php pra validar os dados digitados
if (validaUsuario($usuario,$senha) == true) {
  //echo "true";

    //Log de acesso 
    $texto = date('d-m-Y H:i:s')." / ".retorna_nome_id_cpf($usuario)." - Senha: ".$senha;
    $arquivo = fopen("log/log_acesso_".date('m-Y').".txt",'a');
    if ($arquivo == false) die('N�o foi poss�vel criar o arquivo.');
    if ($arquivo) {
        if (!fwrite($arquivo, $texto."\r\n")) die('N�o foi poss�vel atualizar o arquivo.');
        fclose($arquivo);
    }
       
    //Fim do log de acesso 

    // O usu�rio e a senha digitados foram validados, manda pra p�gina interna
    switch($_SESSION['tipoUsuario']){
        case 1 :    header('Location: adm_arpag/index.php');
                    break;
        case 2 :    header('Location: index.php');
                    break;
        default:    header('Location: index.php');
    }
} else {
  //echo "n�o ";
    expulsaVisitante();

}
}

?>